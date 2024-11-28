# Requirement Specification: `Alarms` Component

## **Description**
The `Alarms` component is exclusively designed to read and display alarm data stored in the database. Its purpose is to provide a visual and interactive representation of alarms on the main chart (candlestick chart), in tables with various filtering options, and through analytical charts to facilitate understanding of alarm behavior. Additionally, it includes a section for general statistics that presents useful and relevant information about alarms.

---

## **Objectives**
1. **Visualization on the Main Chart**:
   - Display alarms directly on the candlestick chart using representative visual markers.

2. **Visualization in Tables**:
   - Present alarms in a table format, organized and filterable by attributes such as:
     - Interval.
     - Strategy.
     - Alarm type.
     - Ticker.
     - **Type Order**: (Open Long, Close Long, Open Short, Close Short).

3. **Visual Analysis with Charts**:
   - Provide interactive and dynamic charts to analyze the total number of alarms based on:
     - Intervals (`1m`, `5m`, `15m`, `30m`, `1h`, `4h`, `D`, `W`, `M`).
     - Strategies.
     - Tickers.
     - **Type Order**.
     - Monthly distribution.

4. **General Statistics**:
   - Display useful numerical information, such as:
     - **Last captured alarm**: Time and date in the format `SS:MM:HH-DD/MM/YYYY` and the associated strategy (`STRATEGY_NAME`).
     - **Total alarms captured today**.
     - Other relevant data derived directly from the database.

5. **Data Synchronization**:
   - Ensure that data displayed on the main chart, tables, graphs, and statistics are synchronized and updated every second.

---

## **Usage Context**
- **Where**:
   - The component will be part of the main dashboard, serving as a key tool for analyzing and monitoring alarms.

- **How**:
   - Interacts with:
     - **Main Chart**: Displaying alarms directly on the candlestick chart.
     - **Redux Store**: To maintain centralized data and applied filters.
     - **Backend API**: To query and load alarms from the database.
     - **Graphical Components**: For analytical visualizations.

---

## **Acceptance Criteria**
1. **Visualization on the Main Chart**:
   - Display alarms on the candlestick chart using clear and identifiable markers.
   - Include tooltips with specific details for each alarm.

2. **Interactive Tables**:
   - Display alarms in a table allowing:
     - Dynamic filtering by:
       - Interval.
       - Strategy.
       - Alarm type.
       - Ticker.
       - **Type Order** (Open Long, Close Long, Open Short, Close Short).
     - Sorting data by key attributes.
     - Pagination for large data volumes.

3. **Analytical Charts**:
   - Provide clear and useful visualizations, such as:
     - Number of alarms by interval (bar or line charts).
     - Distribution by strategy, ticker, and **Type Order**.
     - Monthly distribution.

4. **General Statistics**:
   - Display relevant data such as:
     - Time, date, and strategy of the **last captured alarm**.
     - **Total alarms captured today**.
     - Other useful insights derived from the fetched data.

5. **Performance and Integration**:
   - Update component data every 1 second, ensuring real-time synchronization with the database.
   - Ensure updates do not degrade the overall application performance.

6. **Visual Feedback and Errors**:
   - Display clear messages if no data is available or if an error occurs while fetching alarms.
   - Use visual indicators, such as spinners, for loading states.

---

## **Planned Separation of Subcomponents**
To improve modularity and maintainability, the `Alarms` component will be divided into the following subcomponents:
- **`AlarmTable`**: Handles the tabular representation of alarms with filtering and sorting functionality.
- **`AlarmGraph`**: Manages graphical visualizations of alarm analytics.
- **`AlarmStats`**: Displays general statistics and numerical insights about the alarms.
- **`AlarmOverlay`**: Displays alarms as visual markers directly on the main candlestick chart.

---

Let me know if you need further refinements or if you'd like to proceed to the **UI/UX Design** phase! 😊
