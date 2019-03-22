#include <stdlib.h>
#include <stdio.h>
#include <string.h>
#include <unistd.h>
#include <curl/curl.h>

/**              
 * main - uses strdup to create a new string, loops forever-ever
 *                
 * Return: EXIT_FAILURE if malloc failed. Other never returns
 */
int main(void)
{
     unsigned long int i;
     char *s;
     s = strdup("http://shopedia.com/demo/hackwagon.png");
     if (s == NULL)
     {
          fprintf(stderr, "Can't allocate mem with malloc\n");
          return (EXIT_FAILURE);
     }
     i = 0;
     while (s)
     {
          printf("\n\n");
          printf("[%lu] Performing File Download\n", i);
          printf("[%lu] %s (%p)\n", i, s, (void *)s);
          sleep(2);
          i++;
          CURL *curl;
          FILE *fp;
          CURLcode res;
          char outfilename[FILENAME_MAX] = "hackwagon.png";
          curl = curl_easy_init();                                                                                                                                                                                                                                                           
          if (curl)
          {   
               fp = fopen(outfilename,"wb");
               curl_easy_setopt(curl, CURLOPT_URL, s);
               curl_easy_setopt(curl, CURLOPT_WRITEFUNCTION, NULL);
               curl_easy_setopt(curl, CURLOPT_WRITEDATA, fp);
               res = curl_easy_perform(curl);
               curl_easy_cleanup(curl);
               fclose(fp);
          } 
     }
     return (EXIT_SUCCESS);
}