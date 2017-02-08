/* IPC Using Message Queue - Receiver Code */
#include <stdio.h>
#include <stdlib.h>
#include <errno.h>
#include <string.h>
#include <sys/types.h>
#include <sys/ipc.h>
#include <sys/msg.h>

int main(void)
{
    int mqID;
    int len;
    key_t key;
    char txt[100];

    key=333;

    if ((mqID = msgget(key, 02666)) == -1) {
        perror("msgget");
        exit(1);
    }
    
    printf("\nMessage Queue Created...");
 
    while(1)
    {

	printf("\n\nWaiting For Message From Sender....");	

        if (msgrcv(mqID, &txt, sizeof(txt), 0,0) == -1) 
            perror("msgsnd");

	printf("\nMessage Received: %s",txt);

	if(strcmp(txt,"bye")==0)
		break;

	printf("\n\nEnter Message: ");	
        gets(txt);

        len = strlen(txt);

        if (msgsnd(mqID, &txt, len, 0) == -1) 
            perror("msgsnd");

	if(strcmp(txt,"bye")==0)
		break;
    }

    msgctl(mqID,IPC_RMID,NULL);

    printf("\n\nExited....\n\n");
    return 0;
}
