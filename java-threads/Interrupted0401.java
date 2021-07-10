// Código criado a partir de https://docs.oracle.com/javase/tutorial/essential/concurrency/interrupt.html

public class Interrupted0401 implements Runnable {

    public void run() {
    
    while(true) {
		
		for(long i=0; i<1000000000; i++)
			;
			
		if (Thread.interrupted()) {
			System.out.println("Fui interrompido ...");
			return;
			}
		else
			System.out.println("Estou executando ...");

		
		}
    
    
	}

    
        
    public static void main(String args[]) {
 
 		Thread t = (new Thread(new Interrupted0401()));
		t.start();
		
		try {
		Thread.sleep(50000);
		System.out.println("Vou encerrar a thread");
		t.interrupt();
		}catch (InterruptedException e) {
        // We've been interrupted: no more messages.
        System.out.println("Vou encerrar também");
        return;
		}
		
		System.out.println("Vou encerrar o programa principals");
        
    }
    
}
