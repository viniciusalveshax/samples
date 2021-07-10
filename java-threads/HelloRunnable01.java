//Código de https://docs.oracle.com/javase/tutorial/essential/concurrency/index.html

public class HelloRunnable01 implements Runnable {

    public void run() {
        System.out.println("Hello from a thread!");
    }

    public static void main(String args[]) {
        (new Thread(new HelloRunnable01())).start();
    }
}
