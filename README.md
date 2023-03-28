**Пример кода**

Запрос приходит в SendController, формируется Dto и передается в SenderService

В SenderService через RequestService создается Request, отправляется, и ответ обрабатывается через Mapper и возвращается ResponseDto обратно в контроллер
