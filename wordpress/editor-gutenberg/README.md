# Gutenberg

## theme.json

This theme.json disables all features that can be disabled via [theme.json](https://developer.wordpress.org/block-editor/how-to-guides/themes/global-settings-and-styles/).

### Opt-in into UI controls

There’s one special setting property, `appearanceTools`, which is a boolean and its default value is false. Themes can use this setting to enable the following ones:

- background: backgroundImage, backgroundSize
- border: color, radius, style, width
- color: link
- dimensions: aspectRatio, minHeight
- position: sticky
- spacing: blockGap, margin, padding
- typography: lineHeight
