#include <cstdio>
#include <cstdlib>
#include <cstring>
#include "TimerContext.h"

#define TIMER_BEGIN 0
#define TIMER_END 1


FILE *php_file, *perf_file, *log_file;
unsigned int file_size;
char *buffer;

char *php_log_file_var = "$UWI_ML_PERF_PHP_FILE";
char *php_log_filename = "uwi_ml_perf_php_log.txt";

char *prefix = "$UWI_ML_PERF_PHP_MICROTIME_";
unsigned int timers = 0;

void php_add_timer( bool with_tags, unsigned int timer )
{
  fprintf(perf_file,"\n\n%s %s%d_%s = microtime(); %s\n\n",(with_tags?"<?php":""),
  		  prefix,timers,((timer==TIMER_BEGIN?"BEGIN":"END")),(with_tags?"?>":""));	
}



void php_log_file_open( bool with_tags )
{
	fprintf(perf_file,"\n\n%s %s=fopen(\"%s\",\"w\"); %s\n\n", (with_tags?"<?php":""),php_log_file_var,
			php_log_filename,(with_tags?"?>":"")); 	
}


void php_log_file_close( bool with_tags )
{
	 fprintf(perf_file,"\n\n%s fclose(%s); %s\n\n", (with_tags?"<?php":""),
			 php_log_file_var,(with_tags?"?>":"")); 	
}


void php_log_to_file( bool with_tags, char *message )
{
  fprintf(perf_file,"\n\n%s fprintf(%s,\"%s\"); %s\n\n",(with_tags?"<?php":""),php_log_file_var,
  		 message,(with_tags?"?>":""));
}


unsigned int* log_times( )
{
	unsigned int *runtimes = (unsigned int*)malloc(sizeof(unsigned int)*timers);
	if( !runtimes ) return NULL;
	

}


typedef struct PHPCONTEXT
{
 
} PHPCONTEXT;


int main(int argc, char *argv[])
{		
	/*
	if( argc != 4 )
		{
			printf("Usage: %s <filename> <perf_filename> <log_file>\n\n",argv[0]);
			exit(1);
		}
	
	
	
	if( !(php_file = fopen(argv[1],"r")) )
		{
			printf("Failed to open %s for reading!\n\n",argv[1]);
			exit(1);
		}
		
	file_size = fseek(php_file,0,SEEK_END);
	file_size = ftell(php_file);
	rewind(php_file);
	buffer = (char*)malloc(file_size+1);
	memset(buffer,'\0',file_size+1);
	fread( buffer, sizeof(char), file_size, php_file );
	fclose(php_file);
		
	
	if( !(perf_file = fopen(argv[2],"w")) )
		{
			printf("Failed to open %s for writing!\n\n",argv[2]);
			exit(1);
		}
		
	if( !(log_file = fopen(argv[3],"w")) )
		{
			printf("Failed to open %s for writing!\n\n",argv[3]);
		}
		
	
	php_add_timer(true,TIMER_BEGIN);
	
	
    fwrite(buffer,1,strlen(buffer),perf_file);
	
	php_add_timer(true,TIMER_END);

	php_log_file_open(true);
	php_log_to_file(true,"TEST START");

	php_log_to_file(true,"TEST END");
	php_log_file_close(true);

	fclose(perf_file);
	free(buffer);
	*/
	
	TimerContextList *list = createTimerContextList();
	
	unsigned int x = 1;
	startContext( list, x++, TIMER_LOOP_FOR);
	startContext( list, x++, TIMER_LOOP_FOR);
	startContext( list, x++, TIMER_LOOP_FOR);
	
	endContext( list, x++ );
	endContext( list, x++ );
	endContext( list, x++ );
	
	
	printList( list );
	
	return 0;
}




