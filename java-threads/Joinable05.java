// Código criado a partir de https://docs.oracle.com/javase/tutorial/essential/concurrency/


public class Joinable05 implements Runnable {
	
	private int line;
	int m[][] = { {1, 2, 3}, {4, 5, 6}, {7, 8, 9} };
	int soma[] = {0, 0, 0};
	

    public void run() {
		
		System.out.println(line);
		int i, total;
		
		total = 0;
		
		for(i=0; i<3; i++)
			total = total + m[line][i];
			
		soma[line] = total;
		
	}
		

	public Joinable05(int n) {
		line = n;
	}
    
        
    public static void main(String args[]) {
		
		
		Thread t[] = new Thread[3];
		
		int i;
		
		for(i=0; i<3; i++){
		 t[i] = new Thread(new Joinable05(i));
		 t[i].start();
		}
		
		try{  
  
		for(i=0; i<3; i++)
			t[i].join();
			
    
		}catch(Exception e)
			{System.out.println(e);
		}  
		
		System.out.println("Vou encerrar o programa principal");
        
    }
    
}

