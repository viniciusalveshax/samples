//Código de https://docs.oracle.com/javase/tutorial/essential/concurrency/index.html


public class HelloThread02 extends Thread {

    public void run() {
        System.out.println("Hello from a thread!");
    }

    public static void main(String args[]) {
        (new HelloThread02()).start();
    }

}
