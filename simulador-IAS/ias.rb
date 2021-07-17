$memory_length         = 1000
$memory_file           = 'Programa_teste_IAS.txt'  # Arquivo da memoria

$cache_kind            = 'associatebyconjunts'      # 'associative' ou 'direct' ou 'associativebyconjunts'
$cache_algorithm       = 'fifo'      # 'random' ou 'fifo'
$cache_length          = 4            # Tamanho da cache
$cache_conjunts_number = 16             # Se for associativa por conjuntos esse parametro determina o numero de conjuntos

$debug                 = true          # Mostra informacoes durante a execucao

class RAM
	def initialize
		@memory = [] # Memoria inicialmente esta vazia
	end
	def load_from_file
		f = File.open($memory_file, 'r')
		f.each_line do |line|
			if line =~ /[A-Z]|[a-z]/ # Verifica se tem letras
				@memory.push(line) # Se tem letras eh uma instrucao, armazena como string
			else
				@memory.push(line.to_i) #Se nao tem letras eh um valor, armazena como valor
			end
		end
		f.close
		for i in (@memory.length+1)..$memory_length
			@memory.push(0) # Preenche a memoria com zeros
		end
	end
	def set(position,value)
		if $debug
			puts 'M(' + position.to_s + ') = ' + value.to_s
		end
		if position >= $memory_length
			puts "Posicao de memoria invalida"
			exit
		else
			@memory[position] = value
		end
	end
	def get(position)
		if position >= $memory_length
			puts "Posicao de memoria invalida"
			exit
		else
			@memory[position]
		end
	end
	def debug_memory(initial_pos, end_pos)
		for i in initial_pos..end_pos
			puts @memory[i].to_s
		end
	end
	def save_to_file
		f = File.open($memory_file, 'w')
		@memory.each do |memory_element|
			f.puts memory_element.to_s
		end 
		f.close
	end
end

class Cache
	def initialize
		@cache_miss = 0
		@cache_hit  = 0
	end
	def miss!
		@cache_miss = @cache_miss + 1
	end
	def hit!
		@cache_hit = @cache_hit + 1
	end
	def miss?
		@cache_miss
	end
	def hit?
		@cache_hit
	end
	def set_ram(ram)
		@ram = ram
	end
	def load_to_cache(address)
		value = @ram.get(address)
		set_cache(address,value)
	end
end

class AssociativeByConjunts < Cache
	def initialize
		@cache_conjunts_number = $cache_conjunts_number # Numero de conjuntos da cache
		@conjunt_lines         = $cache_length / @cache_conjunts_number
		@conjunts  = []
		for i in 1..@cache_conjunts_number
			@conjunts.push([]) # Adiciona um conjunto ao conjunto de conjuntos O_o
		end
		@algorithm = $cache_algorithm
		@next = nil
		super
	end
	def get(address)
		conjunt_number = address % @cache_conjunts_number
		conjunt = @conjunts[conjunt_number]
		conjunt.each do |cache_line|
			if cache_line != nil
				if cache_line.has_key?(address)
# 					hit!
					return cache_line[address]	
				end
			end
		end
# 		miss!
		load_to_cache(address)
		return false
# 		get(address)
	end
	def set_cache(address, value)
		conjunt_number = address % @cache_conjunts_number
		if @algorithm == 'random'
			position = rand @conjunt_lines
		else
			if @next == nil
				position = 0
				@next    = 1
			else
				position = @next
				@next   = @next + 1
				if @next >= @conjunt_lines
					@next = 0
				end
			end
		end
		conjunt = @conjunts[conjunt_number]
		conjunt[position] = { address => value }
	end
	def invalidate!(address)
		conjunt_number = address % @cache_conjunts_number
		conjunt = @conjunts[conjunt_number]
		conjunt.each_with_index do |cache_line, index|
			if cache_line != nil
				if cache_line.has_key?(address)
					conjunt[index] = {}
				end
			end
		end
	end
end

class Associative < Cache
	def initialize
		@length    = $cache_length
		@cache     = Array.new # Armazena a cache em si
		@algorithm = $cache_algorithm # Armazena o algoritmo de substituicao
		@next      = nil # Armazena o primeiro a ser substituido no caso do fifo
		super # Chama o construtor de cache
	end
	def get(address)
		@cache.each do |cache_item|
			if cache_item != nil
				if cache_item.has_key?(address)
# 					hit!
					return cache_item[address]
				end
			end
		end
		load_to_cache(address)
		return false
# 		miss!
# 		get(address) # Busca novamente o endereco na cache
	end

	def set_cache(address,value)
		if @cache.length < @length # Ainda existe espaco na cache?
			#Usa o espaco disponivel
			@cache.push({address => value})
			return true
		else
			# Usa um dos algoritmos de substituicao
			if @algorithm == 'random' # O algoritmo a usar eh o randomico?
				# Escolhe uma posicao aleatoria
				position = rand @length
			else
				# FIFO
				if @next == nil
					# Cache encheu pela primeira vez
					position = 0 # Substitui na posicao 0
					@next    = 1 # Na proxima vez vai substituir a posicao 1
				else
					position = @next
					@next = @next + 1
					if @next >= tamanho # Testa se a fila circular chegou ao fim
						@next = 0 # Volta para o inicio
					end
				end
			end
			@cache[position] = {address => value}
		end
	end

	def invalidate(address)
		@cache.each_with_index do |cache_item, index|
			if cache_item != nil
				if cache_item.has_key?(address)
					@cache[index] = {}
				end
			end
		end
	end
end

class Direct < Cache
	def initialize
		@length = $cache_length
		@cache  = Hash.new
		super
	end
	def get(address)
		position = address % @length
		label    = address / @length
		if @cache.has_key?(position)
			cache_block = @cache[position]
			if cache_block.has_key?(label)
# 				hit!
				return cache_block[label]
			else
# 				miss!
				load_to_cache(address)
				return false
# 				get(address)
			end
		else
# 			miss!
			load_to_cache(address)
			return false
# 			get(address)
		end
	end
	def set_cache(address, value)
		position = address % @length
		label    = address / @length
		@cache[position] = { label => value }
	end
	def invalidate(address)
		position = address % @length
		@cache.delete(position)
	end
end

class Memory # Abstracao para acessar a memoria ou a cache
	def initialize
		@ram    = RAM.new
		@ram.load_from_file
		case $cache_type
			when "direct"
				@cache = Direct.new
			when "associative"
				@cache = Associative.new
			else
				@cache = AssociativeByConjunts.new
		end
		@cache.set_ram(@ram)
	end
	
	def miss?
		return @cache.miss?
	end

	def hit?
		return @cache.hit?
	end

	def get(address, count_cache_hit)
		value = @cache.get(address) # Procura na cache se existir
		if value # Verifica se o valor estava na cache
			if count_cache_hit
				@cache.hit!
			end
		else
			if count_cache_hit
				@cache.miss!
			end
			value = @cache.get(address) #Retorna o valor
		end
		return value
	end

	def set(address,value)
		if @cache.get(address) #Procura o valor na cache
			# Se o valor estava na cache invalida o que estava la e carrega o novo valor
			@cache.invalidate!(address)
			@ram.set(address,value)
# 			@cache.load_to_cache(address)
# 			return 
# 		else
# 			@ram.set(position,value)
# 			@cache.load_to_cache(position)
		end
	end

	def set_address(position, side, value)
		if side == 'left'
			bit_start = 28
		else
			bit_start = 8
		end
		tmp_value = get(position,true)
# 		puts tmp_value.to_s
		bit_end = bit_start + 11
		for bit in bit_start..bit_end
			if ( value & (2 ** (bit-bit_start)) ) == 0 # testa o (bit-bit_start) do valor
				# Se o bit for zero, zera o bit da memoria
# 				printf("Valor:\n%b=\n%b AND com\n%b\n",tmp_value & ( 0xffffffffff - (2**bit) ),tmp_value,( 0xffffffffff - (2**bit) ))
				tmp_value = tmp_value & ( 0xffffffffff - (2**bit) )
			else
				# Se o bit nao for zero, seta o bit da memoria
# 				printf("Valor:\n%b=\n %b OR com\n%b\n",tmp_value | (2**bit),tmp_value,2**bit)
				tmp_value = tmp_value | (2**bit)
			end
		end
		set(position,tmp_value)
	end

	def get_address(position,side)
		if side == 'left'
			bit_start = 28
		else
			bit_start = 8
		end
		address = 0
		bit_end = bit_start + 11
		tmp_value = get(position,true)
		for bit in bit_start..bit_end
			if (tmp_value & (2**bit)) != 0 # Testa se o i-esimo bit da memoria eh zero
				# Se nao for adiciona 1 na respectiva posicao
# 				puts "Bit " + bit.to_s + ' nao eh zero'
				address = address | (2**(bit-bit_start))
			end
		end
		return address
	end

	def save
		@ram.save_to_file
	end

end

class IAS
	def initialize
		@acc     = 0
		@mq      = 0
		@pc      = 0
		@memory  = Memory.new
	end

	def next_step
		next_instruction = @memory.get(@pc,true) # Busca a proxima instrucao
		if next_instruction.class != Integer # Verifica se eh uma string
			execute(next_instruction) # Se for uma string, executa
		end
		@pc = @pc + 1
	end

	def execute(str)
		if str =~ /LOAD/ # Procura a expressao LOAD na str
			ld(str.split(' ')[1])
		elsif str =~ /STOR/
			store(str.split(' ')[1])
		elsif str =~ /JUMP/
			jump(str.split('P')[1])
		elsif str =~ /ADD/
			add(str.split(' ')[1])
		elsif str =~ /SUB/
			subtr(str.split(' ')[1])
		elsif str =~ /MUL/
			mult(str.split(' ')[1])
		elsif str =~ /DIV/
			div(str.split(' ')[1])
		elsif str =~ /LSH/
			@acc = @acc << 1 # Rotaciona 1 bit para a esquerda ( * 2 )
		elsif str =~ /RSH/
			@acc = @acc >> 1 # Rotaciona 1 bit para a direita ( / 2 )
		elsif str =~ /HALT/
			@exit = true
		end
	end	

	def keep_running?
		!@exit
	end

	def div(command)
		@acc = @acc / @memory.get(get_position(command,true))
	end

	def mult(command)
		tmp_mult = @mq * @memory.get(get_position(command,true))
		@mq      = tmp_mult & 0xFFFFFFFFFF # Pega os bits menos significativos
		@acc     = tmp_mult >> 40         # Pega os bits mais significativos
	end

	def subtr(command)
		position = get_position(command)
		if command =~ /\|/
			@acc = @acc - (@memory.get(position,true)).abs # Subtrai o valor do modulo
		else
			@acc = @acc - @memory.get(position,true)
		end
	end

	def add(command)
		position = get_position(command)
		if command =~ /\|/
			@acc = @acc + (@memory.get(position,true)).abs
		else
			@acc = @acc + @memory.get(position,true)
		end
	end

	def jump(command)
		position, side = get_position_and_side(command)
		address = @memory.get_address(position,side)
		if command =~ /\+/ # Testa se o loop eh condicional
			if @acc > 0
				# Se o acumulador > 0 entao salta
				@pc = address
			end
		else
			# Loop nao eh condicional
			@pc = address
		end
		if $debug
			puts "Saltando para: " + @pc.to_s
		end
	end

	def ld(command)
		if command =~ /\(/ # Procura um ( no comando
			position = get_position(command)
			value    = @memory.get(position,true)
			if command =~ /MQ/
				# command = LOAD MQ,M(x)
				@mq = value
			else
				if command =~ /\|/ # Procura um | no comando
					if command =~ /-/ # Procura um - no comando
						# command = LOAD -|M(x)|
						@acc = -(value.abs)
					else
						# command = LOAD |M(x)|
						@acc = value.abs
					end
				else
					if command =~ /-/ # Procura um - no comando
						# command = LOAD -M(x)
						@acc = -value
					else
						# command = LOAD M(x)
						@acc = value
					end
				end
			end
		else
			# command = LOAD MQ
			# ACC <- MQ
			@acc = @mq
		end
	end

	def store(command)
		if command =~ /,/ # Procura por uma , no comando
			position, side = get_position_and_side(command)
			@memory.set_address(position,side, @acc)
		else
			# command = STOR M(X)
			position = get_position(command)
			@memory.set(position, @acc)
		end
	end

	def save_memory
		@memory.save
	end

	def cache_miss
		puts 'Cache miss: ' + @memory.miss?.to_s
	end

	def cache_hit
		puts 'Cache hit:  ' + @memory.hit?.to_s
	end

	private
	def get_position(command) # Recupera a posicao de memoria
		return command.split('(')[1].split(')')[0].to_i
	end

	def get_position_and_side(command)
		position = command.split('(')[1].split(',')[0].to_i  # Endereco de memoria
		side     = (command =~ /19/) ? 'left' : 'right' # Bits 8-19 ou 28-39 ?
		return position,side
	end

end

# a = RAM.new
# a.load_from_file
# a.debug_memory(10,20)
# a.set(11,2)
# puts a.get(11).to_s
# puts a.get(11).to_s
# a.save_to_file
# cache = Direct.new
# cache.set_ram(a)
# value = cache.get(11)
# puts cache.miss?.to_s
# puts cache.hit?.to_s
# value = cache.get(11)
# puts cache.miss?.to_s
# puts cache.hit?.to_s
# cache.invalidate(11)
# puts cache.miss?.to_s
# puts cache.hit?.to_s

# m = Memory.new
# m.get(1)
# puts 'Miss: ' + m.miss?.to_s
# puts 'Hit:  ' + m.hit?.to_s
# m.get(1)
# puts 'Miss: ' + m.miss?.to_s
# puts 'Hit:  ' + m.hit?.to_s
# m.set(1,2)
# m.get(1)
# puts 'Miss: ' + m.miss?.to_s
# puts 'Hit:  ' + m.hit?.to_s
# puts m.get(1).to_s
# puts m.get(2).to_s
# m.set(2,20)
# puts m.get(2).to_s
# m.set_address(2,'left',11)
# puts m.get_address(2,'left')

ias = IAS.new

while ias.keep_running? # Verifica se o programa acabou
	ias.next_step # Roda a proxima instrucao
end

ias.save_memory

ias.cache_miss
ias.cache_hit
