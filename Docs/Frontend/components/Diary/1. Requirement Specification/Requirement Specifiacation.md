# Requirement Specification

## **Initial Questions**

### **General Purpose**

- **What is the primary function of this component in the application?**
  The `Diary` component will allow users to record, view, and manage journal entries related to their trading activity (Create, delete, modify, and update journal entries).

- **What specific problem does it solve or what functionality does it add?**

  - Provides an organized space to document and analyze decisions, results, and notes related to strategies, operations, and alarms.
  - Displays a calendar panel showing journal entries. Hovering over a date with entries will show a dropdown or window summarizing the entries. Users must be able to click on the entries displayed in the dropdown or window.

### **Usage Context**

- **Where will this component be located within the user interface?**
  It will be accessed through the NavBar. A Chart component will be displayed alongside a calendar panel on the right. Below, there will be a CRUD and a card-based viewer for the diary entries.

- **What other components will it interact with (if applicable)?**

  - `Alarms`: To associate entries with specific alarms.
  - `Orders`: To associate entries with specific orders.
  - `Positions`: To associate entries with specific positions.
  - With itself to link entries to other entries.
  - `Charts`: To display diary entries as markers on the chart.

### **Target Users**

- **Who will use this component?**
  Traders and investors looking to maintain a detailed record of their activity.

### **Input and Output**

- **What data does the component need to function (inputs)?**
  - Date and time of the entry.
  - Title of the entry.
  - Journal text.
  - Attach images or files.
  - References to strategies, alarms, orders, or positions.

- **What data or elements does it produce as a result (outputs)?**
  - A list of entries organized by date.

### **Acceptance Criteria**

- **What metrics or conditions will determine whether this component is complete or functional?**
  - Ability to create, edit, and delete entries.
  - Organized visualization by date.
  - Functional filters (e.g., by associated strategy or alarm).

### **Style and Design**

- **Do you have a specific style in mind for this component?**
  Minimalist, with an emphasis on writing and organization.

- **Will it be a responsive design?**
  No, it will not be responsive.

---

## **Building the Requirement Specification**

### **Description**

The `Diary` component allows users to record daily entries related to their trading activity. Its primary goal is to provide an organized documentation space linked to other functionalities in the application.

### **Objectives**

- Enable users to:
  - Create diary entries with relevant information.
  - Associate entries with alarms, strategies, orders, or positions.
  - Attach optional files.
  - Search and filter entries.
  - View summarized entries interactively via a calendar.

### **Usage Context**

- **Where:**
  Within the dashboard, in a dedicated tab or panel.
- **How:**
  Interacts with alarms, charts, and trading reports components.

### **Acceptance Criteria**

- Create, edit, and delete entries without errors.
- View entries in an organized and filterable list.
- Clear and user-friendly design.
- Display summarized details when interacting with calendar dates.

### **Style and Design**

- Minimalist and organized, with an emphasis on writing.
- Non-responsive.
- Compatible with light and dark themes.

---

