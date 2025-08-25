Checklist of Potential Web Application Enhancements:

Dynamic In-Text "Lore Links" (Beyond Characters/Locations):
Highlight key terms or objects within the narrative text.
Clicking these could either:
Open the Codex directly to a relevant new entry type (e.g., Technology, Historical Event).
Open a small, non-intrusive "glossary/footnote" panel for quick definitions or images.
"Captain's Log" or "Character Journal" Entries:
Integrate clickable icons or specially styled paragraphs within chapters.
Clicking would reveal character-specific thoughts, logs, or observations (potentially loaded from separate .md files).
These entries could also be collected and browsable within a new "Journals" or "Logs" tab in the Codex.
Dynamic HUD / Status Display (Currently in progress):
Display contextual information like ship status (hull, life support, fuel, and eventually shields, weapons, ammo) that changes based on narrative events. 
Trigger these updates via special comments in the Markdown files. 
The initial status for a chapter will be set by the first HUD comment in its Markdown file. 

Codex Enhancements ("Civilopedia-like" vision):
Related Entries: At the bottom of a character or location detail view, automatically list and link to other relevant Codex entries.
Image Galleries: For locations or characters, allow viewing of multiple images (e.g., thumbnails, simple slideshow).
New Lore Categories & Tabs:
"Cut Scenes" / Bonus Textual Content: Short stories, deleted scenes, author notes, in-universe historical documents (loaded from .md files).
Potentially "Technology," "Factions," "Historical Events," etc., each with its own JSON data structure and display logic.
Sidebar Table of Contents Scalability:
If a single Story Series grows to have many "Books" (Volumes), consider:
Nested accordions for larger "Saga Parts" or "Trilogies" above the individual Book/Volume level.
A "Jump To Book" dropdown at the top of the sidebar for very long lists of Books.
Refining In-Content Table of Contents (within introduction.md or volume_intro.md):
Ensure links to volumes (#volume-key) or specific parts (#part-key) within the Markdown are handled gracefully by JavaScript (e.g., scrolling to an anchor, expanding a section in the sidebar). Currently, only #chapter-key links are fully implemented for navigation.
Further Styling & UI/UX Polish:
Animations and transitions for UI elements.
Refinements to typography, spacing, and overall visual appeal.
Enhanced accessibility features beyond the basics.