//Código da função main modificado a partir do link abaixo
//https://ciksiti.com/pt/chapters/3884-calling-getpid-function-in-c-with-examples--linux-hint

#include <stdio.h>
#include <sys/types.h>
#include <unistd.h>

// getNameByPid function code by
// https://ofstack.com/C++/9293/linux-gets-pid-based-on-pid-process-name-and-pid-of-c.html
#define BUF_SIZE 1024

void getNameByPid(pid_t pid, char *task_name) {
    char proc_pid_path[BUF_SIZE];
    char buf[BUF_SIZE];
    sprintf(proc_pid_path, "/proc/%d/status", pid);
    FILE* fp = fopen(proc_pid_path, "r");
    if(NULL != fp){
        if( fgets(buf, BUF_SIZE-1, fp)== NULL ){
            fclose(fp);
        }
        fclose(fp);
        sscanf(buf, "%*s %s", task_name);
    }
}


int main(void) {

char name[100];
int pid        = getpid();
int parent_pid = getppid();

printf("PID process %d\n", pid);
printf("Parent PID  %d\n", parent_pid);

//getNameByPid(pid, name);
//printf("%s\n",name);

return 0;

}
