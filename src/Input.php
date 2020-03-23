<?php
declare(strict_types=1);

namespace HtmlObject;

/**
 * Class Input
 *
 * @method self setClass(string $class)
 * @method self setId(string $id)
 * @method self setName(string $name)
 * @method self setPlaceholder(string $class)
 * @method self setValue(string $value)
 *
 * @package App\Service\HtmlObject
 */
final class Input extends AbstractBaseElement
{
    /**
     * The tag/element name to be created
     *
     * @var string
     */
    public const TAG = 'input';

    /**
     * @var mixed
     */
    protected array $attributes = [
        'class' => '',
        'id' => '',
        'name' => null,
        'placeholder' => 'Placeholder...',
        'required' => null,
        'value' => ''
    ];

    /**
     * Set input type
     *
     * @param  string|null  $type
     *
     * @return \HtmlObject\Input
     */
    public function setType(?string $type = null): Input
    {
        // if (in_array($type, self::TYPES, true) === false) {
        //     throw new \RuntimeException('Unsupported type exception');
        // }

        $this->attributes['type'] = $type;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getTagName(): string
    {
        return self::TAG;
    }
}
