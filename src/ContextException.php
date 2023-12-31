<?php

namespace Garden\Utils;

/**
 * Exception that can provide some context for logs.
 */
class ContextException extends \RuntimeException
{
    /** @var array Any context you want. */
    protected array $context;

    /**
     * Constructor.
     *
     * @param string $message The exception message.
     * @param int $code The error code.
     * @param array $context Extra context for the exception.
     * @param \Throwable|null $previous The previous exception for chaining.
     */
    public function __construct(string $message = "", int $code = 0, array $context = [], \Throwable $previous = null)
    {
        $this->context = $context;
        parent::__construct($message, $code, $previous);
    }

    /**
     * Add extra context to an exception.
     *
     * This can't be an immutable clone because exceptions aren't cloneable.
     *
     * @param array $context
     *
     * @return $this
     */
    public function withContext(array $context): self
    {
        $this->context = array_replace($this->context, $context);

        return $this;
    }

    /**
     * Return some context for the exception.
     *
     * @return array
     */
    public function getContext(): array
    {
        return $this->context;
    }

    /**
     * Laravel works directly with this method.
     *
     * @return array
     */
    public function context(): array
    {
        return $this->getContext();
    }

    /**
     * Get our error code as an HTTP status code.
     */
    public function getHttpStatusCode(): int
    {
        $code = $this->getCode();
        if ($code >= 400 && $code <= 599) {
            return $code;
        } else {
            return 500;
        }
    }
}
