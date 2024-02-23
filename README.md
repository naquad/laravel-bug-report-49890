# Bug Reproduction

A proof of concept for the misbehavior of the ShouldBeUnique mechanism
with the missing model.

Issue: [https://github.com/laravel/framework/issues/49890](https://github.com/laravel/framework/issues/49890)

Pull request with the fix: [https://github.com/laravel/framework/pull/50211](https://github.com/laravel/framework/pull/50211)

Execute the following:

```
git clone https://github.com/naquad/laravel-bug-report-49890.git
cd laravel-bug-report-49890
cp .env.example .env
./artisan migrate
./artisan app:poc
```
