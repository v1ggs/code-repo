# Gutenberg

## [theme.json](https://developer.wordpress.org/block-editor/how-to-guides/themes/global-settings-and-styles/)

For Gutenberg blocks, `theme.json` is supported in both block and classic themes. This `theme.json` disables most (if not all) features that can be turned off via `theme.json`. You can re-enable needed features or extend blocks to add custom controls.

Some block controls can't be disabled through `theme.json`. To remove those, you'll also need to extend the block.

### Opt-in into UI controls

There's one special setting property, `appearanceTools`, which is a boolean and its default value is false. Themes can use this setting to enable the following ones:

- background: backgroundImage, backgroundSize
- border: color, radius, style, width
- color: link
- dimensions: aspectRatio, minHeight
- position: sticky
- spacing: blockGap, margin, padding
- typography: lineHeight
