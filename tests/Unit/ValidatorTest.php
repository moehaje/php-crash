<?php

use Core\Validator;

it('validates a string', function () {
   $result = Validator::string('foobar');

   expect($result)->toBeTrue()
       ->and(Validator::string(false))->toBeFalse()
       ->and(Validator::string(''))->toBeFalse();

});

it('validates a string with a minimum length', function () {
    expect(Validator::string('foobar', 20))->toBeFalse();
});

it('validates a string with a maximum length', function () {
    expect(Validator::string('foobar', 1, 5))->toBeFalse();
});

it('validates an email', function () {
    expect(Validator::email('foobar'))->toBeFalse()
        ->and(Validator::email('foobar@example.com'))->toBeTrue();
});

it('validates that the number is greater than a given amount', function () {
    expect(Validator::greaterThan(10, 1))->toBeTrue()
        ->and(Validator::greaterThan(10, 100))->toBeFalse();
})->only();