# **Testing Documentation for Strateger-React**

## **1. Introduction**

The purpose of this documentation is to provide a comprehensive guide for testing the **Strateger-React** application. This document outlines the types of tests used, the file structure, the libraries employed, and best practices to ensure software quality.

## **2. Project Testing Structure**

The folder structure for the application's tests is organized as follows:

src/
├── components/
│   └── Alarms/
│       ├── __tests__/
│       │   ├── Alarms.test.jsx
│       │   └── index.test.jsx
│       └── components/
│           ├── AlarmTab.test.jsx
│           └── AlarmFiltersPanel/
│               ├── FiltersMenu/
│               │   └── FiltersMenu.test.jsx
│               └── AlarmInfoPanel/
│                   ├── AlarmsBarChart/
│                   │   ├── AlarmsGraphByMonth.test.jsx
│                   │   └── components/
│                   │       ├── MonthToggleButton.test.jsx
│                   │       └── MonthTogglePanel.test.jsx
│                   └── hooks/
│                       ├── useGenerateChartData.test.jsx
│                       └── useUpdateVisibleMonths.test.jsx
│                   ├── AlarmsRadarChart/
│                   │   └── ChartAlarmsByTime.test.jsx
│                   └── AlarmOverviewPanel/
│                       └── GeneralStatistics.test.jsx
│           └── AlarmTable/
│               ├── AlarmTable.test.jsx
│               └── Pagination.test.jsx

This structure follows a pattern that clearly separates test files by component, facilitating maintenance and updates.

---

## **3. Types of Tests**

1. **Unit Tests:** Validate the functionality of a single component, hook, or module.
2. **Integration Tests:** Verify the interaction between multiple components.
3. **UI Tests:** Validate the correct rendering of the user interface.
4. **State (Redux) Tests:** Validate the interaction between Redux and components.

---

## **4. Testing Tools**

- **Jest**: Main testing framework.
- **React Testing Library**: Used to interact with the component's DOM.

---

## **5. Test Naming Conventions**

1. **File Structure:**
   - Tests are placed in `__tests__` folders or directly with the `.test.jsx` extension next to the main file.
   - Test files should follow the convention: `ComponentName.test.jsx`.

2. **Test Names:**
   - Use the format **"should..."**.
   - Examples:
     - "Should render the main container."
     - "Should display an error message when there is no data."

---

## **6. Test Structure**

Each test is organized as follows:

1. **Test Description:** Explains what the test is verifying.
2. **Data Preparation and Mocking:** Initialization of mock data and methods.
3. **Action (Act):** Execution of the action being tested.
4. **Assertions (Assert):** Validation that the result matches the expectation.

---

## **7. Key Test Cases**

### **7.1. Component Tests**

### **FiltersMenu.test.jsx**

**Key Cases:**
1. Should render the filter button.
2. Should open and close the filter menu.
3. Should toggle the state of the checkboxes.
4. Should apply the selected filters.

### **MonthToggleButton.test.jsx**

**Key Cases:**
1. Should correctly render the month buttons.
2. Should toggle the CSS class based on visibility state.
3. Should call `toggleMonth` function when a button is clicked.

### **MonthTogglePanel.test.jsx**

**Key Cases:**
1. Should correctly render the panel container.
2. Should toggle the visible state of the months.
3. Should correctly pass props to the `MonthToggleButton` component.

### **AlarmTable.test.jsx**

**Key Cases:**
1. Should correctly render table columns.
2. Should select an alarm when clicking on a row.
3. Should display "No Data" when there are no records.

### **Pagination.test.jsx**

**Key Cases:**
1. Should render the "Previous" and "Next" pagination buttons.
2. Should disable the "Previous" button if the page is 0.
3. Should call `setPage` when changing the page.

---

## **8. Hook Tests**

### **useGenerateChartData.test.jsx**

**Key Cases:**
1. Should not call `setChartData` if the alarm data is empty.
2. Should generate the correct data format for the chart.
3. Should correctly handle invalid data.

### **useUpdateVisibleMonths.test.jsx**

**Key Cases:**
1. Should not call `setVisibleMonths` if `alarmsData` is `null` or `undefined`.
2. Should correctly calculate visible months based on alarm data.

---

### **AlarmTable.test.jsx**

**Key Actions:**
1. `setFilteredByClickAlarms`: Confirm that it is called correctly when clicking on a row in the table.

---

## **10. Testing Commands**

To run the tests, use the following command:
```bash
npm test
```
To run a specific test, use:
```bash
npm test -- TestName
```

To view test coverage:
```bash
npm run test:coverage
```

## **11. Best Practices**
1. Create utility methods to reduce code duplication.
2. Use screen.debug() to identify issues with element selection.
3. Avoid unnecessary mocks.

## **12. Conclusion**
This documentation provides a comprehensive guide for testing Strateger-React. Be sure to follow best practices and keep tests updated according to system changes. This will ensure the stability and quality of the software.