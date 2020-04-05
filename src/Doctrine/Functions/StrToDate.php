<?php

/*
 * This file is part of the ABGEO/StalinList project.
 *
 * (c) Temuri Takalandze <me@abgeo.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Doctrine\Functions;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

/**
 * Class StrToDate.
 *
 * @category Functions
 * @package  App\Doctrine
 */
class StrToDate extends FunctionNode
{
    public $dateString = null;

    public $dateFormat = null;

    /**
     * {@inheritDoc}
     */
    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->dateString = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->dateFormat = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    /**
     * {@inheritDoc}
     */
    public function getSql(SqlWalker $sqlWalker)
    {
        return 'STR_TO_DATE('.$this->dateString->dispatch($sqlWalker).', '.$this->dateFormat->dispatch($sqlWalker).')';
    }
}
