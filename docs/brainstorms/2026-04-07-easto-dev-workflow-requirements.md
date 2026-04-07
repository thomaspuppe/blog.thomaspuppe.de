---
date: 2026-04-07
topic: easto-dev-workflow
---

# Easto Dev Workflow Standardization

## Problem Frame

`blog.thomaspuppe.de` currently depends on easto via a local file path (`"easto": "../easto"`), which npm resolves as a symlink. This works locally but is non-portable (requires easto checked out at exactly `../easto`), not community-standard, and feels like a hack. The goal is to use `npm link` — the npm-blessed tool for co-developing two packages — and make the blog's `package.json` reference the GitHub repo so it is usable standalone.

Publishing easto to npm is a future goal but is out of scope here.

## Requirements

**Blog repo (blog.thomaspuppe.de)**
- R1. `package.json` dependency on easto points to the GitHub repo: `"easto": "thomaspuppe/easto"` (installs from the default branch when cloned fresh)
- R2. A short note in the README (or CONTRIBUTING section) documents the local dev setup: run `npm link` in the easto repo, then `npm link easto` in the blog repo

**Easto repo**
- R3. `easto/package.json` has no changes required — it is already `npm link`-compatible
- R4. (Optional) Add a note to the easto README explaining it can be linked into consuming projects during development

**Local dev workflow**
- R5. The two-step `npm link` workflow replaces the manual symlink. After linking, changes in easto are immediately reflected in the blog build without any reinstall step.

## Success Criteria
- A fresh `npm install` in the blog repo installs easto from GitHub, with no dependency on the local directory structure
- During local development, `npm link easto` creates a proper managed symlink; no manual `../easto` path manipulation needed
- The workflow is documented clearly enough for a new contributor to follow

## Scope Boundaries
- Publishing easto to npm is explicitly deferred — that is a separate effort
- No monorepo / workspace restructuring
- No changes to the blog's build scripts or easto_config.json

## Key Decisions
- **GitHub ref over local path**: `"thomaspuppe/easto"` makes the blog repo portable while still allowing local override via `npm link`
- **npm link over npm workspaces**: workspaces would require merging repos; `npm link` is the right tool for two separate repos

## Next Steps
→ `/ce:plan` for structured implementation planning (or proceed directly — scope is small enough to implement without a formal plan)
