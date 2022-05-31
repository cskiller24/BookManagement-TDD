# TODO

| Previews   | Examples      | Meaning                                                                                     |
|------------|---------------|---------------------------------------------------------------------------------------------|
| Italics    | _Italic Text_ | Refers to namespace of the project                                                          |
| Bold       | **Bold Text** | Refers to HTTP [Request Methods](https://developer.mozilla.org/en-US/docs/Web/HTTP/Methods) |
| Code Block | `Code Text`   | Refers to URI of the project                                                                |

- [x] Create backend project
- [x] Create database model
- [x] Test project if working
- [x] Create database and migration
- [x] Create models w/ fillable and cast
- [x] Add relationships to models
- [x] Create factories
- [x] Create seeders
- [x] Test factories and seeders
- [x] Test for seeders
- [x] Add Laravel Sanctum to the project
- [x] Add a dummy middleware api endpoint

## Auth Endpoints

- [x] Add login and register endpoints

### LoginController

- [x] Add register rontroller
- [x] Add register request and validation
- [x] Add register user
- [x] Add rest to register session

### RegisterController

- [x] Add login controller
- [x] Add login request and validation
- [x] Add login user
- [x] Test login controller session

### General

- [x] Modify resources for LoginController
- [x] Modify resources for RegisterController
- [x] Add resources (User, Book, Genre, Review, Login, Register)
- [x] Add routes api
- [x] Add controllers
- [x] Test routes and controllers api

## Books endpoint

### BookController@Index

- [x] Add Books endpoint **GET** `/api/books`
  - [x] Paginate books `/api/books`
  - [x] Sort books by title A - Z `/api/books?sortBy=title`
  - [x] Sort books by number of published by author `/api/books?sortBy=author`
  - [x] Sort books by favorites `/api/books?sortBy=favorites`
  - [x] Sort by most reviewed books `/api/books?sortBy=reviews`
  - [x] Sort by recently added `/api/books?sortBy=recent`
- [x] Test all books endpoint

### BookController@Show

- [x] Search books **GET** `/api/books/{id}`

### BookController@Create

- [x] Add create book endpoint **POST** `/api/books`
  - [x] Create validation
  - [x] Must be verified by email
- [x] Test create books endpoint

### BookController@Update

- [ ] Add update books endpoint **PUT** `/api/books/{id}`
  - [ ] Verify the user is the author of the book before updating using policies
  - [ ] Customize form request validation for update books endpoint _Http/Request/BookRequest_
- [ ] Add test cases for update books

### BookController@Delete

- [ ] Add delete books endpoint **DELETE** `api/books/{id}`
  - [ ] Verify the user is the author of the book before deleting
- [ ] Add test cases for delete books

### BookController@addFavorite

- [ ] Add favorite books endpoint **POST** `api/books/{id}`
  - [ ] User must not be the author of the book
  - [ ] Must be authenticated
- [ ] Add test case for favorite books endpoint

### BookController@deleteFavorite

- [ ] Add delete favorite books endpoint `api/books/{id}`
  - [ ] Must be authenticated
- [ ] Add test case for favorite books endpoint

## Polymorphic Images Endpoint

- [ ] Add polymorphic images Migration
- [ ] Add polymorphic images Model
- [ ] Add polymorphic images Factory
- [ ] Add polymorphic images Seeder
- [ ] Add polymorphic images Cover Feature  

### ImageController@createBooksImages

- [ ] Add create books images endpoint **POST** `api/books/{id}/images`
  - [ ] Check if the user is the author of the books before proceeding
  - [ ] Author can add many photos in a book
  - [ ] Create validation for maximum 3 photos per books
- [ ] Add test case for Create Books Endpoint

### ImageController@updateBooksImages

- [ ] Add update books images endpoint **PUT** `api/books/{id}/images/{id}`
  - [ ] Check if the user is the author of the books before proceeding
  - [ ] Book author can choose a picture as featured photo of a book
  - [ ] The book buthor can only add one photo as a featured photo
  - [ ] If there is already a featured photo it cannot be processed
  - [ ] Author can can turn a featured photo to non-featured photo
- [ ] Add test case for update books images endpoint

### ImageController@deleteBooksImages

- [ ] Add delete books images endpoint **DELETE** `api/books/{id}/images/{id}`
  - [ ] Check if the user is the author of the books before proceeding
  - [ ] User cannot delete the image of the image is featured
- [ ] Add test case for delete books images endpoint

## Reviews Endpoint

### ReviewController@index

- [ ] Add display reviews endpoint **GET** `api/books/{id}/reviews`
- [ ] Add test case for display reviews endpoint

### ReviewController@userIndex

- [ ] If user is authenticated there's an option to get all the user reviews **GET**`api/reviews`
- [ ] Add test case for user reviews endpoint

### ReviewController@create

- [ ] Add create reviews endpoint **POST** `api/books/{id}/reviews`
  - [ ] Cannot add a review if the user is the author of the book
- [ ] Add test case for create reviews endpoint

### ReviewController@update

- [ ] Add update reviews endpoint **PUT** `api/books/{id}/reviews/{id}`
  - [ ] User cannot update the star of their review
  - [ ] Check if the review belongs to the user
- [ ] Add test case for update reviews endpoint

### ReviewController@delete

- [ ] Create delete reviews endpoint **DELETE** `api/books/{id}/reviews/{id}`
  - [ ] Check if the review belongs to the user
- [ ] Add test case for delete reviews endpoint
