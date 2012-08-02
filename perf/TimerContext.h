
#ifndef _TIMER_CONTEXT_H_


#define TIMER_LOOP_FOR		0
#define TIMER_LOOP_FOREACH	1
#define TIMER_LOOP_WHILE	2
#define TIMER_LOOP_DO_WHILE	3
#define TIMER_SCRIPT		4
#define TIMER_FUNCTION		5
#define TIMER_ERROR			6

typedef unsigned char TimerType;


typedef struct TimerContext
{
	unsigned int lineStart;
	unsigned int lineEnd;
	
	unsigned int timerStart;
	unsigned int timerEnd;
	
	struct TimerContext *nextContext;
	struct TimerContext *prevContext;
	
	TimerType timerType;

} TimerContext ;



typedef struct TimerContextList
{
  TimerContext *headNode;
  TimerContext *endNode;
  unsigned int contextCount;
} TimerContextList;



TimerContext* createTimerContext()
{
   TimerContext *newContext = (TimerContext*)malloc(sizeof(TimerContext));
   if( !newContext ) return NULL;
   
   newContext->lineStart = 0;
   newContext->lineEnd = 0;
   newContext->timerStart = 0;
   newContext->timerEnd = 0;
   
   newContext->nextContext = NULL;
   newContext->prevContext = NULL;
   
   newContext->timerType = TIMER_ERROR;
   
   return newContext;
}


TimerContextList *createTimerContextList()
{
	TimerContextList *newList = (TimerContextList*)malloc(sizeof(TimerContextList));
	newList->headNode = newList->endNode = NULL;
	newList->contextCount = 0;
	return newList;
}


void addContextToList( TimerContext *context, TimerContextList *list )
{
  TimerContext **ptrToNode = &list->headNode;  
  TimerContext *prevNode = NULL;
  
  while( *ptrToNode ) 
  	{
	 prevNode = *ptrToNode;
	 ptrToNode = &((*ptrToNode)->nextContext);
	}
  
  context->prevNode = prevNode;	
  *ptrToNode = context;  
  
  list->endNode = context;
}



unsigned int startContext( TimerContextList *list, unsigned int lineNumber, TimerType type )
{
 unsigned int timerNumber = list->contextCount;
 ++list->contextCount;
 TimerContext *newContext = createTimerContext();
 newContext->timerStart = timerNumber;
 newContext->lineStart = lineNumber;
 newContext->timerType = type;
 addContextToList( newContext, list );
 return timerNumber;
}


unsigned int endContext( TimerContextList *list, unsigned int lineNumber )
{
  unsigned int timerNumber = list->contextCount;
  ++list->contextCount;
  list->endNode->lineEnd = lineNumber;
  list->timerEnd = timerNumer;
  
  TimerContext *oldheadNode = list->headNode;
  TimerContext *secondToLastNode = list->endNode->prevNode;
  
  list->headNode = list->endNode;
  list->headNode->nextContext = oldHeadNode;
  list->endNode = secondToLastNode;
  
  secondToLastNode->nextContext = NULL;
  return timerNumber;
}



void printList( TimerContextList *list )
{
	TimerContext *context = list->headNode;
	while( context )
		{
		 printf("[%u : %u]->",context->timerStart,context->timerEnd);
		}
	printf("NULL");
}




#endif





