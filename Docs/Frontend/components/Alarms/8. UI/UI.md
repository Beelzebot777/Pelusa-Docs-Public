
# **Styling and Theming**

## **Color Palette**
To ensure consistency in the application's appearance, the following color palette is defined:

- **Primary Color**: `#4F46E5` - Used for primary actions, main buttons, and key indicators.
- **Secondary Color**: `#A393BF` - Used for secondary actions, background highlights, and less prominent elements.
- **Accent Color**: `#22C55E` - Used for success states, confirmation actions, and positive indicators.
- **Error Color**: `#EF4444` - Used for error states, form validation errors, and destructive actions.
- **Warning Color**: `#F59E0B` - Used for warning indicators, caution alerts, and yellow highlights.
- **Text Colors**:
  - **Primary Text**: `#1A1A1A` - Main text used for headlines and key information.
  - **Secondary Text**: `#403A43` - Used for less prominent information.
  - **Disabled Text**: `#6B7280` - Used for disabled actions or unavailable content.

---

## **Typography**
The application's typography system ensures consistent and readable text across all devices.

- **Font Family**:
  - **Primary Font**: `Roboto, sans-serif`
  - **Secondary Font**: `Inter, sans-serif`

- **Font Sizes & Weights**:
  - **H1**: 32px, Bold
  - **H2**: 24px, Bold
  - **H3**: 20px, Semi-Bold
  - **Body Text**: 16px, Regular
  - **Small Text**: 14px, Regular
  - **Button Text**: 16px, Bold
  - **Label/Caption**: 12px, Bold

---

## **Standardization**
The following guidelines establish standard styles for common UI components to maintain visual and interactive consistency.

### **Buttons**
- **Shape**: Rounded corners (`border-radius: 8px`)
- **States**: Normal, Hover, Active, Disabled
- **Hover Effect**: Background darkens on hover (e.g., `hover:bg-primary-600`)
- **Disabled State**: Reduced opacity and cursor `not-allowed`
- **Padding**: `12px 24px`

### **Inputs**
- **Border**: `1px solid #D1D5DB`
- **Padding**: `12px 16px`
- **Focus Outline**: `2px solid #4F46E5`
- **Placeholder Color**: `#9CA3AF`

### **Tabs**
- **Active State**: Background color `#4F46E5`, text color `#FFFFFF`, underline indicator.
- **Inactive State**: Text color `#6B7280`, no underline, and hover effect to increase brightness.

### **Cards**
- **Shadow**: `box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1)`
- **Border-Radius**: `12px`
- **Padding**: `16px 24px`
- **Background**: `#FFFFFF`

### **Tooltips**
- **Background**: `#1A1A1A`
- **Text Color**: `#FFFFFF`
- **Font Size**: `12px`
- **Border-Radius**: `4px`
- **Arrow**: Centered with the tooltip, inherits the background color

---

## **Spacing and Layout**
Spacing standards ensure visual balance and predictable layout across all UI components.

- **Global Padding**: `16px`
- **Global Margin Between Sections**: `24px`
- **Spacing Units**: Follows the 4px system (e.g., 4px, 8px, 12px, 16px, 20px, 24px, 32px, 40px, 48px)
- **Content Width**:
  - **Desktop**: `max-width: 1200px`
  - **Tablet**: `max-width: 768px`
  - **Mobile**: Full width with padding of `16px`

---

## **Component-Specific Styles**
Here are specific styles for certain key components that require additional attention.

### **Chart Markers**
- **Border**: `1px solid #CCCCCC`
- **Background Color**: Matches the chart's data color
- **Size**: `12px x 12px`
- **Hover Effect**: Slight increase in size (`transform: scale(1.1)`) and increase in brightness

### **Modals**
- **Background Overlay**: `rgba(0, 0, 0, 0.6)`
- **Modal Box**: Centered with `max-width: 600px`, **border-radius** of `12px`, and **padding** of `24px`

### **Form Fields**
- **Field Height**: `48px`
- **Spacing Between Fields**: `16px`
- **Error State**: Border changes to `#EF4444`, with an error message in red below the input

---

## **Responsiveness**
To ensure a consistent experience on all devices, the following responsive design principles are applied.

- **Breakpoints**:
  - **Mobile**: `0px - 768px`
  - **Tablet**: `768px - 1024px`
  - **Desktop**: `1024px and above`

- **Font Size Adjustments**:
  - On smaller devices (below `768px`), reduce font sizes for headers and body text. Example: H1 becomes 24px instead of 32px.

- **Layout Adjustments**:
  - For mobile devices, switch from **grid layout to stacked layout** to ensure vertical alignment.
  - Use **flex direction: column** for stacked elements on mobile.

- **Button Adjustments**:
  - Full-width buttons on smaller devices (`width: 100%`)
  - Reduce the horizontal padding from `24px` to `16px` on smaller devices.

- **Responsive Images**:
  - Use `object-fit: cover` for images to maintain aspect ratio.
  - Ensure images are set to `max-width: 100%` on mobile to prevent overflow.

---

This **Styling and Theming Guide** serves as a central resource for maintaining a unified and consistent design system. Follow these principles to create scalable, maintainable, and accessible user interfaces.
