<?php

/*
 * This file is part of EmailChecker.
 *
 * (c) Matthieu Moquet <matthieu@moquet.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EmailChecker\Tests\Constraint;

use EmailChecker\Constraints\NotThrowawayEmail;
use EmailChecker\Constraints\NotThrowawayEmailValidator;

class NotThrowawayEmailValidatorTest extends \PHPUnit_Framework_TestCase
{
    protected $context;
    protected $validator;

    protected function setUp()
    {
        $this->context = $this->getMock('Symfony\Component\Validator\ExecutionContext', array(), array(), '', false);
        $this->validator = new NotThrowawayEmailValidator();
        $this->validator->initialize($this->context);
    }

    protected function tearDown()
    {
        $this->context = null;
        $this->validator = null;
    }

    public function testNullIsValid()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validator->validate(null, new NotThrowawayEmail());
    }

    public function testEmptyStringIsValid()
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validator->validate('', new NotThrowawayEmail());
    }

    /**
     * @expectedException \Symfony\Component\Validator\Exception\UnexpectedTypeException
     */
    public function testExpectsStringCompatibleType()
    {
        $this->validator->validate(new \stdClass(), new NotThrowawayEmail());
    }

    /**
     * @dataProvider getValidEmails
     */
    public function testValidEmails($email)
    {
        $this->context->expects($this->never())
            ->method('addViolation');

        $this->validator->validate($email, new NotThrowawayEmail());
    }

    public function getValidEmails()
    {
        return array(
            array('matthieu@moquet.com'),
            array('john.doe@gmail.com'),
        );
    }

    /**
     * @dataProvider getInvalidEmails
     */
    public function testInvalidEmails($email)
    {
        $constraint = new NotThrowawayEmail(array(
            'message' => 'myMessage'
        ));

        $this->context->expects($this->once())
            ->method('addViolation')
            ->with('myMessage');

        $this->validator->validate($email, $constraint);
    }

    public function getInvalidEmails()
    {
        return array(
            // Invalid emails
            array('example@'),
            array('example@example.com@example.com'),
            // Throwaway emails
            array('example@yopmail.com'),
            array('example@trashmail.net'),
        );
    }
}