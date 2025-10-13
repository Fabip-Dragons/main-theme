# Copilot Instructions
# This file is used to provide instructions to GitHub Copilot about the repository.
# You can customize the instructions to help Copilot better understand the context of your code.
# For more information, see https://docs.github.com/en/copilot/getting-started-with-github-copilot/customizing-copilot-suggestions
# Please write code in the style and conventions used in this repository.
# You can also provide specific instructions for certain files or directories by using comments.
# For example, to provide instructions for a specific file, you can use the following format:
# File: path/to/your/file.ext
# <Your instructions here>
# To provide instructions for a specific directory, you can use the following format:
# Directory: path/to/your/directory/
# <Your instructions here>
# Please keep the instructions concise and relevant to the code in the repository.
# Thank you for using GitHub Copilot!
# Happy coding! 😊

# General Instructions:
# - Follow the coding style and conventions used in this repository.
# - Write clear, concise, and well-documented code.
# - Ensure code is efficient and optimized for performance.
# - Include error handling and edge case considerations.
# - Write unit tests for new features and bug fixes.
# - Use meaningful variable and function names.
# - Follow best practices for security and data privacy.
# - Follow the acf pro coding standards for block development.
# - Ensure compatibility with the latest version of WordPress and PHP.
# - Ensure the page is responsive and works well on different screen sizes and devices.
# - Use semantic HTML5 elements for better accessibility and SEO.
# - Follow the principles of DRY (Don't Repeat Yourself) and KISS (Keep It Simple, Stupid).
# - Follow VS code formatting settings for all files.
# - Use tabs for indentation.

## JavaScript Instructions:
- Use ES6+ syntax and features.
- Prefer `const` and `let` over `var`.
- Variable must be in camelCase.
- Use arrow functions for anonymous functions.
- Use template literals for string interpolation.

## Php Instructions:
- Follow PSR-12 coding standards.
- Use meaningful variable and function names in camelCase.
- Include type hints for function parameters and return types.
- Use namespaces and autoloading for better organization.
- Follow VS code formatting settings for PHP files.
- Be very clear in comments and docblocks.

## json Instructions:
- Use 2 spaces for indentation.
- Use double quotes for keys and string values.
- Ensure proper comma placement and avoid trailing commas.
- Maintain a consistent structure for similar objects.
- documentation: https://developer.wordpress.org/block-editor/reference-guides/theme-json-reference/theme-json-living/

## theme.json Instructions:
- colors must follow the color palette provided in the css instructions.
- font sizes must be consistent with the design system.
- fluid typography must be used for better responsiveness.
- spacing values must be consistent and follow a scale (e.g., 0, 4, 8, 16, 32, 64).
- Ensure proper nesting and organization of properties.
- Follow VS code formatting settings for json files.

## css Instructions:
- Use kebab-case for class and ID names.
- Organize CSS properties in a consistent order (e.g., position, display, box model, typography, visual).
- Use comments to separate sections of CSS for better readability.
- Primary color: #922EDC
- Secondary color: #691D9B
- Dark background color: #300D44
- Light background color: #D1A8F0
- Text color on dark background: #ffffff
- Text color on light background: #000000