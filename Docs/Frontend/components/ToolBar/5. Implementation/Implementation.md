# **Implementation Plan for Component: `Toolbar`**

## **Code Structure**
### **1. Main Structure:**
The `Toolbar` component acts as the main container for various toolbar functionalities. It incorporates multiple subcomponents for modularity and clarity:

1. **Toolbar:**
   - A wrapper that renders the `ToolBarContainer`, responsible for managing the toolbar state and coordinating between its subcomponents.

2. **ToolBarContainer:**
   - Handles the state and logic of the toolbar, such as `currentInterval`, `currentTicker`, and `jumpToDate`.
   - Connects with the Redux store to synchronize global states like `temporalidad` and `date ranges`.
   - Contains the following subcomponents:
     - `TickersPanel`: Allows users to select a ticker.
     - `IntervalBarContainer`: Manages interval selection.
     - `IndicatorsPanel`: Provides options for selecting indicators.
     - `JumpInTimePanel`: Enables date-based navigation.
     - `RelojContainer`: Displays a countdown or clock.

3. **Subcomponents:**
   - **`TickersPanel`:** Dropdown-style ticker selection using `@headlessui/react`.
   - **`IntervalBarContainer`:** Houses `IntervalBar`, which displays interval buttons with hover and focus effects.
   - **`IndicatorsPanel`:** Dropdown-style indicator selection.
   - **`JumpInTimePanel`:** Handles user input for date and time navigation.
   - **`RelojContainer`:** Displays a countdown timer using the `Reloj` component.

### **2. Related Files:**
   - **UI:**
     - `Toolbar.jsx`
     - `ToolBarContainer.jsx`
     - `IntervalBar.jsx`, `IntervalBarContainer.jsx`
     - `IndicatorsPanel.jsx`
     - `JumpInTimePanel.jsx`
     - `TickersPanel.jsx`
     - `RelojContainer.jsx`
   - **Logic:**
     - Redux slice files: `toolBarSlice.js`, `chartsSlice.js`
     - Helper functions: `useHandleParameters.js` (if created).

---

## **Dependencies and Libraries**
### **1. Styling and Design:**
- **Tailwind CSS:** For responsive and custom styling.
- **Headless UI:** For accessible interactive components like dropdowns.

### **2. State Management:**
- **Redux Toolkit:** To handle global states, including `currentInterval`, `currentTicker`, and `date ranges`.

### **3. API Requests:**
- **Axios:** To fetch and update candlestick chart parameters.

### **4. Performance Optimization:**
- **LocalStorage:** Used for caching `chartParameters` to reduce redundant computations.

---

## **Implementation Details**
### **1. Performance Optimization:**
- Implemented `localStorage` caching in `ToolBarContainer` to minimize redundant Redux dispatches when parameters haven't changed.
- Subcomponents like `IntervalBar` and `TickersPanel` dynamically update their states to ensure efficient rendering.

### **2. State Management:**
- `currentInterval`, `currentTicker`, and `jumpToDate` are managed locally within `ToolBarContainer` and synchronized with Redux for persistence.
- `useSelector` is used to fetch initial values from Redux, ensuring global state consistency.

### **3. Accessibility (a11y):**
- Dropdowns (`TickersPanel`, `IndicatorsPanel`) utilize `@headlessui/react` to ensure keyboard and screen-reader compatibility.
- Input fields in `JumpInTimePanel` have proper `aria-label` and focus handling.

### **4. Styling and Theming:**
- Components follow a consistent style guide using Tailwind CSS:
  - **Color Palette:** African Violet shades for consistency.
  - **Hover and Focus States:** Highlighted with `hover:bg-*` and `focus:ring-*` classes.
  - **Minimalist Design:** Rounded corners and smooth transitions for buttons and inputs.

### **5. Component-Specific Details:**
- **`TickersPanel`:**
  - Dynamically updates the `currentTicker` based on user selection.
  - Closes the dropdown after selection using `@headlessui/react`'s `close` function.

- **`IntervalBar`:**
  - Buttons have clear visual feedback for active, hover, and focus states.
  - Uses `flex-grow` to evenly distribute button space across the toolbar.

- **`JumpInTimePanel`:**
  - Provides user inputs for navigating to a specific date.
  - Validates inputs dynamically and offers `CLEAR` and `CurrentDate` functionality without closing the dropdown.

- **`IndicatorsPanel`:**
  - Allows selection of multiple indicators.
  - Utilizes `@headlessui/react` for a professional dropdown experience.

- **`RelojContainer`:**
  - Displays a countdown timer using the reusable `Reloj` component.

---

