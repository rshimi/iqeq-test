<?php

namespace App\Tests\Unit\EventListener;

use App\EventListener\AccessDeniedListener;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Exception\DisabledException;
use Symfony\Component\HttpFoundation\Request;

class AccessDeniedListenerTest extends TestCase
{
    private AccessDeniedListener $listener;

    private EventDispatcher $dispatcher;

    public function setUp(): void
    {
        $this->listener = new AccessDeniedListener();
        $this->dispatcher = new EventDispatcher();

        $this->dispatcher->addListener(
            'onKernelException',
            [$this->listener, 'onAccessDeniedException']
        );
    }

    public function testEventDoesNotSetResponseWhenExceptionIsNotAccessDeniedException(): void
    {
        $exceptionEvent = new ExceptionEvent(
            $this->createMock(HttpKernelInterface::class),
            $this->createMock(Request::class),
            1,
            $this->createMock(DisabledException::class)
        );

        $this->listener->onAccessDeniedException($exceptionEvent);
        $this->assertNull($exceptionEvent->getResponse());
    }

    public function testEventSetResponseWhenExceptionIsAccessDeniedException(): void
    {
        $exceptionEvent = new ExceptionEvent(
            $this->createMock(HttpKernelInterface::class),
            $this->createMock(Request::class),
            1,
            $this->createMock(AccessDeniedException::class)
        );

        $this->listener->onAccessDeniedException($exceptionEvent);
        $this->assertInstanceOf(Response::class, $exceptionEvent->getResponse());
    }
}
