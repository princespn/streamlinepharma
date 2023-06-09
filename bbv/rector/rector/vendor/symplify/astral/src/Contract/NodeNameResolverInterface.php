<?php

declare (strict_types=1);
namespace RectorPrefix202206\Symplify\Astral\Contract;

use PhpParser\Node;
interface NodeNameResolverInterface
{
    public function match(Node $node) : bool;
    public function resolve(Node $node) : ?string;
}
