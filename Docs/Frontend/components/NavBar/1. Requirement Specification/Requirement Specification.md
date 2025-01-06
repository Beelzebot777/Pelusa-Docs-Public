### Requirements Specification for the `NavBar` Component

---

#### **1. Initial Questions**

- **General Purpose**  
  - **Primary Function**: Provide the ability to navigate between different components of the application.  
  - **Problem Solved**: Simplifies navigation between components by centralizing options in an intuitive sidebar.

- **Usage Context**  
  - **Location**: The component will be positioned as a vertical sidebar on the right side of the central panel.  
  - **Interaction**:  
    - It will interact with all main components: `Alarms`, `Account`, `Backtesting`, `BattleField`, `CurrencyConverter`, `Diary`, `Earnings`, `Laboratory`, `Orders`, `Positions`, and `Strategy`.

- **Target Users**  
  - **Users**: Administrators, internal developers, and end-users of the application.

- **Input and Output**  
  - **Inputs**:  
    - Click actions from users to select a component.  
  - **Outputs**:  
    - Displays only the selected component associated with the navigation icon.  
    - Non-selected components are shown with reduced color intensity, indicating they are inactive.  
    - Unimplemented components are disabled and displayed in gray.

- **Acceptance Criteria**  
  - Each component has an associated icon in the `NavBar`.  
  - Users can access each component by clicking on its corresponding icon.  
  - Only one component is displayed at a time.  
  - Icons of non-selected components remain visible but with reduced color intensity.  
  - Icons of unimplemented components are non-clickable and displayed in gray.

- **Style and Design**  
  - **General Style**: Minimalist, composed exclusively of icons.  
  - **Colors**:  
    - Selected component: More intense color (based on the project's purple palette).  
    - Hover: Highlighted with increased color intensity.  
    - Non-selected components: Less intense color, indicating they are inactive.  
    - Unimplemented components: Light gray, indicating they are disabled.  
  - **Responsive**: Yes, the design will adapt to different screen sizes.

---

#### **2. Building the Requirements Specification**

- **Description**  
  The `NavBar` is a vertical navigation bar designed to allow users to navigate between the main components of the application in an intuitive and efficient manner. It serves as a centralized navigation point, with visual cues reflecting the state of each component.

- **Objectives**  
  1. Provide clear and intuitive navigation between the application's main components.  
  2. Associate each component with an icon representing its function.  
  3. Disable unimplemented components and visually differentiate them.  
  4. Display only one selected component at a time, hiding the others.  
  5. Use a visual design that indicates the state of each component (selected, hover, non-selected, unimplemented).  
  6. Implement a minimalist and responsive design.

- **Usage Context**  
  - **Where**:  
    - The navigation bar will be located as a fixed vertical bar on the right side of the central panel.  
  - **How**:  
    - Clicking an icon will display only the corresponding component.  
    - Selected components will appear with increased color intensity.  
    - Non-selected components will have a lower color intensity.  
    - Unimplemented components will be disabled, non-clickable, and displayed in gray.

- **Acceptance Criteria**  
  1. The `NavBar` includes icons for all main components (`Alarms`, `Account`, `Backtesting`, etc.).  
  2. Icons are clickable and allow users to access the associated component.  
  3. Only one component is displayed at a time.  
  4. Icons of non-selected components remain visible but with reduced color intensity.  
  5. Icons of unimplemented components are disabled, non-clickable, and displayed in gray.  
  6. The `NavBar` design adapts correctly to different devices and screen sizes.

---

