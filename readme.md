# ToDo API - README

## Opis

Prosta aplikacja ToDo API, która obsługuje zarządzanie pracownikami, projektami i zadaniami. Zbudowana z wykorzystaniem Laravel, Docker oraz MySQL.

## Wymagania

- Docker
- Docker Compose

## Instalacja i uruchomienie

### 1. Klonowanie repozytorium

```bash
git clone git@github.com:fearovsky/aberit-rec.git
cd aberit-rec
```

### 2. Uruchomienie kontenerów

```bash
docker-compose up -d
```

### 3. Instalacja zależności

```bash
docker-compose exec php composer install
```

### 4. Konfiguracja środowiska

Skopiuj plik `.env.example` do `.env` i dostosuj ustawienia bazy danych oraz inne zmienne środowiskowe.

```bash
cp .env.example .env
```

### 5. Uruchomienie migracji

```bash
 docker-compose exec php php /var/www/laravel/artisan migrate
```

## Informacje dodatkowe

Przy tworzeniu kontrolerów do obsługi relacji (EmployeeProjectController, EmployeeTaskController) musiałem skorzystać z AI, aby zmieścić się w wyznaczonym dwugodzinnym czasie implementacji.

Warto zauważyć, że można było zastosować większą abstrakcję dla repozytoriów, przekazując model do konstruktora. Przykładowo, zamiast implementacji specyficznych repozytoriów dla każdego modelu, możliwe byłoby stworzenie generycznego repozytorium.

Dla servisów i controllerów stworzyć testy

Nie zdołałem niestety przetestować nawet wszystkich endpointów z powodu braku czasu, wydaje mi się, ze wybrałem zbyt rozległe zadanie jak na tak krótki czas
