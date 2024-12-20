<?php

namespace Application\Validator\Post;

use Application\Request\Post\CreatePostRequest;
use Application\Validator\BaseValidator;
use Assert\Assert;
use Assert\LazyAssertionException;

class CreatePostValidator extends BaseValidator
{

    /**
     * @param CreatePostRequest $request
     * @return bool
     */
    public function validate($request): bool
    {
        try {

            Assert::lazy()
                ->that($request->title, 'title')->string()->minLength(4)
                ->that($request->content, 'content')->string()->minLength(10)
                ->that($request->userId, 'userId')->string()
                ->verifyNow();

            return true;

        } catch (LazyAssertionException $e) {

            $this->setErrors($e->getErrorExceptions());

            return false;

        }
    }
}