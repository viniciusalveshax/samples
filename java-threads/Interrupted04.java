// Código criado a partir de https://docs.oracle.com/javase/tutorial/essential/concurrency/interrupt.html

public class Interrupted04 implements Runnable {

    public void run() {
    
        try {
			while(true) {
				Thread.sleep(1000);
				System.out.println("Estou executando ...");
			}	
		} catch (InterruptedException e) {
        // We've been interrupted: no more messages.
        System.out.println("Terminei de executar");
        return;
		}
    
	}

    
        
    public static void main(String args[]) {
 
 		Thread t = (new Thread(new Interrupted04()));
		t.start();
		
		
		try {
		Thread.sleep(5000);
		System.out.println("Vou encerrar a thread");
		t.interrupt();
		}catch (InterruptedException e) {
        // We've been interrupted: no more messages.
        System.out.println("Vou encerrar também");
        return;
		}
		
		System.out.println("Vou encerrar o programa principal");
        
    }
    
}
