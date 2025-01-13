# Logic Design: ToolBar Component

---

## **Responsibilities**
The `ToolBar` component will handle the following internal logic:

1. **Ticker Selection Management**:
   - Update the selected ticker when the user chooses an option from the `Tickers Button` dropdown.
   - Trigger an event to notify the `Charts` component about the selected ticker.

2. **Interval Selection**:
   - Change the active time interval when the user clicks a button in the `Intervals Panel`.
   - Update the data displayed in the `Charts` component to reflect the selected interval.

3. **Indicator Management**:
   - Handle the addition or removal of indicators (e.g., EMAs, Stochastic) selected from the `Indicators` dropdown.
   - Notify the `Charts` component to overlay or remove the selected indicators on the chart.

4. **Jump to Time**:
   - Capture the date and time entered by the user in the `JumpTime` input field.
   - Trigger an event to move the chart to the specified timestamp.
   - Clear the input field when the `Clean Button` is clicked.

5. **Clock Dropdown**:
   - Display the current time and the opening/closing hours of major financial markets in a dropdown.
   - Dynamically update the displayed times in real-time.

6. **Error Handling**:
   - Show appropriate error messages if the user enters an invalid time format or selects an unavailable ticker.

---

## **State and Props**

### **Global State (Managed with Redux)**:
1. `selectedTicker`:  
   - **Type**: `string`  
   - **Purpose**: Stores the currently selected ticker (e.g., `BTCUSD`). Shared with components like `Charts`.

2. `selectedInterval`:  
   - **Type**: `string`  
   - **Purpose**: Stores the active time interval (e.g., `1h`). Used by `Charts` to update displayed data.

3. `activeIndicators`:  
   - **Type**: `Array<string>`  
   - **Purpose**: Stores a list of selected indicators (e.g., `['EMA', 'Stochastic']`). Used by `Charts` to overlay indicators on the chart.

4. `jumpToTime`:  
   - **Type**: `string` (ISO 8601 format)  
   - **Purpose**: Stores the date and time entered for navigation (e.g., `"2025-01-01T12:00:00Z"`). This state is consumed by `Charts`.

### **Local State (Managed with React)**:
1. `isTickersDropdownOpen`:  
   - **Type**: `boolean`  
   - **Purpose**: Manages the visibility of the `Tickers Button` dropdown.

2. `isIndicatorsDropdownOpen`:  
   - **Type**: `boolean`  
   - **Purpose**: Manages the visibility of the `Indicators` dropdown.

3. `isClockDropdownOpen`:  
   - **Type**: `boolean`  
   - **Purpose**: Manages the visibility of the `Clock` dropdown.

### **Props**:
1. `tickers`: Array of available tickers passed to the component (e.g., `[{ id: 'BTCUSD', name: 'Bitcoin/USD' }]`).
2. `intervals`: Array of time intervals (e.g., `['1m', '5m', '15m']`).
3. `indicators`: Array of indicators available for selection (e.g., `[{ id: 'EMA', name: 'Exponential Moving Average' }]`).
4. `marketTimes`: Array of market times passed to the `Clock` dropdown (e.g., `[{ region: 'USA', opening: '09:30', closing: '16:00' }]`).
5. `onTickerChange`: Callback to trigger additional events when the ticker changes (optional if Redux handles global events).
6. `onIntervalChange`: Callback to handle extra logic when intervals change (optional if Redux manages the logic).
7. `onIndicatorsChange`: Callback for custom logic in indicators (optional).
8. `onJumpToTime`: Optional callback to trigger additional events with the selected date and time.

---

## **Events and Handling**
The `ToolBar` component will handle the following events:

### 1. **Ticker Selection**
- **Event**: User selects a ticker from the dropdown.
- **Behavior**:
  - Update the global `selectedTicker` state in Redux.
  - Trigger a global event to update the `Charts` component.

### 2. **Interval Selection**
- **Event**: User clicks a time interval button in the `Intervals Panel`.
- **Behavior**:
  - Update the global `selectedInterval` state in Redux.
  - Trigger a global event to adjust data in `Charts`.

### 3. **Indicator Selection**
- **Event**: User selects or deselects an indicator from the `Indicators` dropdown.
- **Behavior**:
  - Add or remove the indicator from the global `activeIndicators` state in Redux.
  - Notify the `Charts` component to overlay or remove the selected indicators.

### 4. **Jump to Time**
- **Event**: User enters a date and time and clicks the `OK` button.
- **Behavior**:
  - Validate the entered timestamp.
  - Update the global `jumpToTime` state in Redux.
  - Trigger an event to move the chart to the specified timestamp.
- **Event**: User clicks the `Clean Button`.
- **Behavior**:
  - Clear the global `jumpToTime` state in Redux and reset the input field.

### 5. **Clock Dropdown**
- **Event**: User opens the `Clock` dropdown.
- **Behavior**:
  - Update `isClockDropdownOpen` to `true`.
  - Display real-time updates for current and market times dynamically.
- **Event**: User closes the dropdown.
- **Behavior**:
  - Update `isClockDropdownOpen` to `false`.

### 6. **Error Handling**
- **Event**: User enters an invalid timestamp in the `JumpTime` input field.
- **Behavior**:
  - Display an error message indicating invalid input.

---

This design ensures a clear separation between local and global states, leveraging Redux for shared states (`selectedTicker`, `selectedInterval`, `activeIndicators`, `jumpToTime`) and React for UI-specific states (`isDropdownOpen`). This improves scalability and application organization.
