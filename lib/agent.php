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
 * Algorithm the execution of Agent:
 * 1. Bitrix launch static method `Agent::agent()`. Your Agents should be registered in the same format:
 * `\Vendor\Packeage\ClassName::agent();`. All arguments from this method will be duplicated to the object constructor:
 * `agent($arg1, …, $arg2)` → `__construct($arg1, …, $arg2)`.
 * 2. Creates an object of Agent class.
 * 3. Execute `init()` method. Preparatory operations, for example: loading required modules.
 * 4. Execute `execute()` method. Main logic of your Agent.
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
     * All arguments from `agent()` method will be duplicated to the constructor:
     * ```
     * agent($arg1, …, $arg2)` → `__construct($arg1, …, $arg2)
     * ```
     */
    public function __construct()
    {
    }

    /**
     * Running Agent by Bitrix.
     *
     * Bitrix calls this method for run Agent. Your Agents should be registered in the same format:
     * `\Vendor\Packeage\ClassName::agent();`. All arguments from this method will be duplicated to the object constructor:
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
     * For the execute Agent must be overriding the init() and execute() method in a sub-class.
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
     * Checks Agent is the a recurring.
     *
     * @return bool
     */
    public function isRecurring()
    {
        return $this->recurring;
    }
}