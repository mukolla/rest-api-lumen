# Change Log

## [2024-08-28]

Refactor services and add unit tests

### Added
- Service:
    - `CompanyCreationService`
    - `CompanyListingService`
    - `UserRegistrationService`
- Unit Test:
    - `CompanyCreationServiceTest`
    - `CompanyListingServiceTest`
    - `UserRegistrationServiceTest`
    - `Factory\CompanyFactoryTest`
    - `Factory\UserFactoryTest`
    - `BadRequestTest`
    - `SignInTest`
    - `UserTest`
    - `ResetPasswordMailTest`
    - `CompanyTest`
    - `UserTest`

### Changed
- Moved class `CompanyFactory` and `UserFactory` to new directory `Factory`.
- Update Controller:
    - `AuthController`
    - `UserCompaniesController`
    - `UserController`
- Update Response:
    - `BadRequestResponse`
    - `DataResponse`
- Update Model:
    - `Company`
    - `User`
- Update Factory:
    - `UserFactory`
- Update `phpunit.xml`

### Removed
- None

### Fixed
- `ExampleTest`
