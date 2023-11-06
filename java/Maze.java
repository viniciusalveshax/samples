// Código baseado em
// https://pt.stackoverflow.com/questions/1823/como-ler-um-arquivo-de-texto-em-java
// https://www.programiz.com/java-programming/filereader
// https://www.alura.com.br/conteudo/java-collections

import java.util.Scanner;
import java.io.FileReader;
import java.util.List;
import java.util.ArrayList;

public class Maze {

	public static void main(String args[]) {


		ArrayList<String> matrix = new ArrayList<>();

		try {
			Scanner in = new Scanner(new FileReader("sistema-arquivos.txt"));
			
			while (in.hasNextLine()) {
			
				String line = in.nextLine();
				System.out.println(line);
			
				matrix.add(line);
			
			}
		}

		catch(Exception e) {

			e.getStackTrace();

		}
		
		for (int i = 0; i < matrix.size(); i++) {
		
			System.out.println("Linha " + i + ":" + matrix.get(i));
		
		}
				
	}
}



