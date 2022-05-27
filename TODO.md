##### Day 1

- [x] Create Backend Project
- [x] Create Database Model
- [x] Test Project if working

##### Day 2

- [x] Create database at migration
- [x] Create Models w/ fillable and cast

##### Day 3

- [x] Add Relationships to models
- [x] Create Factories
- [x] Create Seeders
- [x] Test Factories and Seeders
- [x] Test for Seeders

##### Day 4

- [x] Laravel Sanctum
- [x] Add a dummy middleware api endpoint
- [x] Add Login and Register Endpoints
- [x] Add Register Controller
- [x] Add Register Request and Validation
- [x] Add Register User
- [x] Add test about the register session
- [x] Add Login Controller
- [x] Add Login Request and Validation
- [x] Add Login User
- [x] Test Login Controller Session

##### Day 5

- [x] Add Resources (User, Book, Genre, Review, Login, Register)
- [x] Modify Resources for LoginController
- [x] Modify Resources for RegisterController
- [x] Add routes api
- [x] Add Controllers
- [x] Test routes and Controllers api

##### Day 6 - Public endpoints

- [x] Add Books endpoint `/api/books`
  - [x] Paginate Books `/api/books`
  - [x] Sort Books by Title A - Z `/api/books?sortBy=title`
  - [x] Sort Books by Number of published by author `/api/books?sortBy=author`
  - [x] Sort Books by Favorites `/api/books?sortBy=favorites`
  - [x] Sort by most reviewed books `/api/books?sortBy=reviews`
  - [x] Sort by recently added `/api/books?sortBy=recent`
- [x] Test all books endpoint

##### Day 7 - Public endpoints 2

- [ ] Search Books `/api/books/{id}`
- [ ] Add Books Images Migration
- [ ] Add Books Images Model
- [ ] Add Books Images Factory
- [ ] Add Books Images Seeder
- [ ] Add Books Images Cover Feature
- [ ] Create Book endpoint `/api/books`
  - [ ] Create Validation
  - [ ] Must be verified by email
- [ ] Test Create Books endpoint

##### Day 8

- [ ] Apply Relationships on `/api/books` endpoint
- [ ] Update Resources for `/api/books`
- [ ] Create Update Books `/api/books/{id}` endpoint
- [ ] Customize form request validation for update books endpoint _Http/Request/BookRequest_

#### Day 9

- [ ] Create Test Cases for Update Books
- [ ] Create Test Cases for Delete Books
- [ ] Create Delete Books `api/books/{id}` endpoint
- [ ] Books Images
  - [ ] Author can add many photos in a book
  - [ ] Add validation for maximum 3 photos per books
  - [ ] Book Author can choose a picture as featured photo of a book
  - [ ] The Book Author can only add one photo as a featured photo

#### Day 10

- [ ] Books Images _continuation_
  - [ ] If there is already a featured photo it cannot be processed
  - [ ] If there is no featured photo the first photo uploded will act as tempporary featured photo
  - [ ] Author can can turn a featured photo to non-featured photo
  - [ ] Author can only remove non-featured photo
  - [ ] To delete a photo the author must remove its featured before deleting
- [ ] Create test case for `Books Images` Endpoint
