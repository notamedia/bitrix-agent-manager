<?php
/**
 * @link https://github.com/notamedia/bitrix-agent-manager
 * @copyright Copyright © 2015 Notamedia Ltd.
 * @license MIT
 */

namespace Notamedia\AgentManager;

/**
 * Abstract class Agent for development simple workers.
 *
 * Algorithm of Agent execution:
 * 1. Bitrix launches static method `Agent::agent()`. Your Agents should be registered in the same format:
 * `\Vendor\Packeage\ClassName::agent();`. All arguments from this method will be duplicated to the object constructor:
 * `agent($arg1, …, $arg2)` → `__construct($arg1, …, $arg2)`.
 * 2. Create an object of Agent class.
 * 3. Call `init()` method. It is needed for some initial operations, for example: loading required modules.
 * 4. Call `execute()` method. This will execute main agent's logic.
 */
abstract class Agent
{
    /**
     * @var bool Agent is recurring.
     */
    protected $recurring = true;

    /**
     * Agent constructor.
     *
     * All arguments from `agent()` method should be duplicated in the constructor, for example:
     * ```
     * agent($arg1, …, $arg2)` → `__construct($arg1, …, $arg2)
     * ```
     */
    public function __construct()
    {
    }

    /**
     * Agent body
     *
     * Bitrix calls this method to run Agent. Your Agents should be registered in the same format:
     * `\Vendor\Packeage\ClassName::agent();`. All arguments from this method should be duplicated in the object constructor:
     * `agent($arg1, …, $arg2)` → `__construct($arg1, …, $arg2)`.
     *
     * @return string
     */
    public static function agent()
    {
        $reflection = new \ReflectionClass(get_called_class());

        /**
         * @var static $worker
         */
        $worker = $reflection->newInstanceArgs(func_get_args());
        $worker->run();

        if ($worker->isRecurring())
        {
            return '\\' . get_called_class() . '::agent();';
        }
    }

    /**
     * Runs the Agent.
     *
     * Notice, that overriding agent's initialisation and body, should be done though `init` and `execute` methods, not here.
     *
     * @see Agent::init()
     * @see Agent::execute()
     */
    public function run()
    {
        $this->init();
        $this->execute();
    }

    /**
     * Initializes the Agent.
     */
    protected function init()
    {
    }

    /**
     * Executes the Agent.
     */
    protected function execute()
    {
    }

    /**
     * Checks if Agent is the a recurring.
     *
     * @return bool
     */
    public function isRecurring()
    {
        return $this->recurring;
    }
}
