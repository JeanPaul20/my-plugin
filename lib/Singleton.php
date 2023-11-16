<?php declare( strict_types = 1 );

namespace My_Plugin;

trait Singleton {
    public function __serialize() : array  {
        throw new \Exception( __('Cannot serialize Singleton.', 'my-plugin') );
    }

    public function __unserialize( array $data ) : void {
        throw new \Exception( __('Cannot unserialize Singleton.', 'my-plugin') );
    }

    private function __clone() {
        _doing_it_wrong(__FUNCTION__, __('You are not allowed to clone this class.', 'my-plugin'), MY_PLUGIN_VERSION);
    }

    private function __wakeup()
	{
		_doing_it_wrong(__FUNCTION__, __('You are not allowed to unserialize this class.', 'my-plugin'), MY_PLUGIN_VERSION);
	}

    protected function __construct() {}

    static final public function setInstance() : ?self {
        static $instance = null;

        $traces = \debug_backtrace( \DEBUG_BACKTRACE_IGNORE_ARGS, 2 );
        $trace = \end( $traces );

        foreach ( [ 'class', 'function' ] as $var )
            $$var = $trace[ $var ] ?? '';

        if ( self::class === $class )
            switch ( $function ) {
                case 'getInstance' : return $instance;
                case 'unsetInstance' : return $instance = null;
            }

        if ( $instance )
            throw new \Exception( __('Singleton instance already exists.' , 'my-plugin'));

        $reflection = new \ReflectionClass( static::class );

        $instance = $reflection->newInstanceWithoutConstructor();

        $constructor = $reflection->getConstructor();
        $constructor->setAccessible( true );
        $constructor->invokeArgs( $instance, \func_get_args() );

        return $instance;
    }

    static final public function getInstance() : ?self {
        return static::setInstance();
    }

    static final public function issetInstance() : bool {
        return (bool)static::getInstance();
    }

    static final public function unsetInstance() : void {
        static::setInstance();
    }
}