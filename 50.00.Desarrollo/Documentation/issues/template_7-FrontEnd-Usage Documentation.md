---
name: Usage Documentation
about: Document how to use the component and its API.
title: "Usage Documentation for [Component Name]"
labels: documentation
assignees: Gaby
---

## **Implementation Examples**
- Provide examples of how to use the component in the application.
  ```jsx
  <FilterBar
    alarms={alarms}
    onFilterApply={(filters) => console.log(filters)}
  />


## **Component API**
| Prop Name	| Type	| Description |	Default |
| ----------- | ----------- | ----------- | ----------- |
| alarms | Array | List of alarms to display. |	[]
| onFilterApply | Func | Callback for filter changes. | null


## **Notes and Warnings**
- Any specific notes for developers.
    - Example: Ensure alarms is non-null to avoid runtime errors.
