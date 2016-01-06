# Agent manager for Bitrix

[![Build Status](https://travis-ci.org/notamedia/bitrix-agent-manager.svg)](https://travis-ci.org/notamedia/bitrix-agent-manager)
[![Latest Stable Version](https://poser.pugx.org/notamedia/bitrix-agent-manager/v/stable)](https://packagist.org/packages/notamedia/bitrix-agent-manager) 
[![Total Downloads](https://poser.pugx.org/notamedia/bitrix-agent-manager/downloads)](https://packagist.org/packages/notamedia/bitrix-agent-manager) 
[![License](https://poser.pugx.org/notamedia/bitrix-agent-manager/license)](https://packagist.org/packages/notamedia/bitrix-agent-manager)

This module help to create simple workers on the Agents of Bitrix.

## Installation

```bash
composer require notamedia/bitrix-agent-manager
```

## Usage

Extends abstract class Agent for create your simple workers. For example:

```php
use Notamedia\AgentManager\Agent;

class SimpleWorker extends Agent
{
    protected $recurring = false; // Agent is not recurring.
    protected $parameter;
    
    public function __construct($parameter)
    {
        parent::__construct();
        
        $this->parameter = $parameter;
    }
    
    protected function init()
    {
        // Preparatory operations.
    }
    
    protected function execute()
    {
        // The basic logic of worker.
    }
}
```