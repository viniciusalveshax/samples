// Código criado a partir de https://docs.oracle.com/javase/tutorial/essential/concurrency/


public class Sync07 implements Runnable {
	
	public void met1() {
		
		long threadId = Thread.currentThread().getId();

		System.out.println(threadId + ": Entrando no método não sincronizado");
		try {
				Thread.sleep(1000);
				System.out.println(threadId + ": Estou executando ...");
				
		} catch (InterruptedException e) {
        // We've been interrupted: no more messages.
        System.out.println(threadId + ": Terminei de executar");

		}
		System.out.println(threadId + ": Saindo do método não sincronizado");

		
	}
	
	public synchronized void met2() {

		long threadId = Thread.currentThread().getId();

		System.out.println(threadId + ": Entrando no método sincronizado");
		try {
				Thread.sleep(1000);
				System.out.println(threadId + ": Estou executando ...");
				
		} catch (InterruptedException e) {
        // We've been interrupted: no more messages.
        System.out.println(threadId + ": Terminei de executar");

		}
		System.out.println(threadId + ": Saindo do método sincronizado");

		
	}
	

    public void run() {

		met1();
		met2();
    
	}
        
    public static void main(String args[]) {
		
		
		Thread t[] = new Thread[3];
		
		int i;
		
		for(i=0; i<3; i++){
		 t[i] = new Thread(new Sync07());
		 t[i].start();
		}
			
		System.out.println("Vou encerrar o programa principals");
        
    }
    
}

