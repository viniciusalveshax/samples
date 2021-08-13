// Código criado a partir de https://docs.oracle.com/javase/tutorial/essential/concurrency/

import java.util.ArrayList;

public class Account {
	
	public static double balance;

	private static class Worker implements Runnable {

		double operations[];
		
		// Muda balanço de forma assíncrona
		// Nem sempre funciona
		public static void change_balance_unsync(double new_value) {
			String thread_name = Thread.currentThread().getName();
			System.out.println("Sou " + thread_name + " e o saldo anterior é " + balance);
			balance = balance + new_value;
			System.out.println(thread_name + ": somei " + new_value + " e alterei o saldo para " + balance);
		}

		// Muda balanço de forma síncrona
		// Sempre funciona
		public static synchronized void change_balance(double new_value) {
			String thread_name = Thread.currentThread().getName();
			System.out.println("Sou " + thread_name + " e o saldo anterior é " + balance);
			balance = balance + new_value;
			System.out.println(thread_name + ": somei " + new_value + " e alterei o saldo para " + balance);
		}

		public void run() {
	    
	    		int j;
	   
	   		// Realiza as operações de depósitos e saques
			try {
		        
		        	for(j=0; j<4; j++){
		        		// change_balance_unsync não é sincronizado entre as threads
		        		// então nem sempre funciona
		        		// troque a função comentada para perceber a diferença
		    			//change_balance_unsync(this.operations[j]);
		    			change_balance(this.operations[j]);
		    			Thread.sleep(1000);
						
		    		}
			
		        
		    	} catch (InterruptedException e) {
		         	System.out.println("Fui interrompido!");
		    	}
	    		
	    				
		}
			

		public Worker(double oper[]) {
			this.operations = oper;
		}
	    

 	}
        
    public static void main(String args[]) {

		// Define os conjuntos de operações de cada thread
		// Valores positivos são depósitos
		// Valores negativos são saques		
		double operations1[] = {100.0, 50.0, 200.0, -60.0};
		double operations2[] = {-10.0, -20.0, -30.0, 100.0};
		
		balance = 0;
		
		Thread t1 = new Thread(new Worker(operations1));
		Thread t2 = new Thread(new Worker(operations2));
		
		// Inicia as threads, cada um com um conjunto de operações a fazer	
		t1.start();
		t2.start();

		// Espera as threads encerrarem antes do programa principal encerrar também		
		try{  
  
			t1.join();
			t2.join();			
    
		}catch(Exception e)
			{System.out.println(e);
		}  

		System.out.println("Saldo final: " + balance);		
		System.out.println("Vou encerrar o programa principal");
        
    }
    
}

