<?php
declare(strict_types=1);

namespace HtmlObject;

/**
 * Class Button
 *
 * @method self setValue(string $value)
 * @method self setId(string $id)
 * @method self setClass(string $class)
 *
 * @package App\Service\HtmlObject
 */
class Button extends AbstractBaseElement
{
    public const STYLES = [
        self::STYLE_DANGER,
        self::STYLE_INFO,
        self::STYLE_PRIMARY,
        self::STYLE_SECONDARY,
        self::STYLE_SUCCESS,
        self::STYLE_WARNING
    ];

    public const STYLE_DANGER = 'btn btn-danger';

    public const STYLE_INFO = 'btn btn-info';

    public const STYLE_PRIMARY = 'btn btn-primary';

    public const STYLE_SECONDARY = 'btn btn-secondary';

    public const STYLE_SUCCESS = 'btn btn-success';

    public const STYLE_WARNING = 'btn btn-warning';

    public const TYPES = [
        self::TYPE_BUTTON,
        self::TYPE_SUBMIT
    ];

    public const TYPE_BUTTON = 'button';

    public const TYPE_SUBMIT = 'submit';

    /**
     * The tag/element name to be created
     *
     * @var string
     */
    public const TAG = 'button';

    /**
     * @var mixed
     */
    protected array $attributes = [
        'class' => '',
        'id' => '',
        'type' => '',
        'value' => '',
    ];

    /**
     * Set style
     *
     * @param  string  $style
     *
     * @return \HtmlObject\Button
     */
    public function setStyle(string $style): Button
    {
        if (in_array($style, self::STYLES, true) === false) {
            throw new \RuntimeException(\sprintf('Unsupported button [%s] style exception', $style));
        }

        $this->attributes['class'] = $style;

        return $this;
    }

    /**
     * Set button type
     *
     * @param  string|null  $type
     *
     * @return \HtmlObject\Button
     */
    public function setType(?string $type = null): Button
    {
        if (in_array($type, self::TYPES, true) === false) {
            throw new \RuntimeException('Unsupported type exception');
        }

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
