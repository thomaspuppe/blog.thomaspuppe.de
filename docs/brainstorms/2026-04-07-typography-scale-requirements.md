---
date: 2026-04-07
topic: typography-scale
---

# Systematic Typography Scale

## Problem Frame

The blog's heading sizes use `clamp()` with `vh`-based fluid values, which scales with viewport *height* rather than width. On small mobile screens (e.g. iPhone 13 mini, 375px wide) the H1 lands at its minimum of 2rem (48px) against a 24px body — dominant and visually disconnected. H2 and H3 end up barely larger than body text, making hierarchy hard to read. Body text at 24px also doesn't scale down on small screens.

The goal is a coherent typographic system: a single base size that scales with viewport width, and heading sizes derived from a consistent mathematical ratio.

## Requirements

**Body text**
- R1. Body font size scales fluidly with viewport width using `clamp`, from ~18px on small mobile to 24px on desktop — replacing the current fixed `font-size: 24px` on `html, body`.
- R2. The `clamp` middle value uses `vw` (not `vh`) so sizing tracks screen width.

**Heading scale**
- R3. All heading sizes (H1, H2, H3) are derived from the body base size using a fixed scale ratio (perfect fourth, 1.333, recommended — planner may verify major third, 1.25, if the ratio feels too large for the serif body).
- R4. H3 = 1 step above body (×1.333 ≈ 1.333rem), H2 = 2 steps (×1.777rem), H1 = 3 steps (×2.369rem).
- R5. Heading sizes use `rem` relative to the fluid base, so they automatically inherit the body's responsive scaling. The `vh`-based `clamp` on headings is removed.
- R6. Heading `line-height` and `letter-spacing` values are reviewed for consistency with the new sizes.

**Scope**
- R7. Changes are limited to `themes/easto/assets/styles.css`. Templates are not touched.
- R8. Dark mode, font families, and layout/spacing properties are not changed.

## Success Criteria
- On iPhone 13 mini (375px), heading hierarchy is clearly readable and H1 no longer overwhelms the page
- Body text is comfortable at mobile sizes without feeling tiny at desktop
- The scale looks deliberate and consistent across breakpoints — heading size relationships feel proportional, not arbitrary

## Scope Boundaries
- Font families (League Spartan, Sina Nova, PT Mono) are not changed
- Layout metrics (max-width, margins, line-height rhythm) are not changed in this pass
- The index page teaser headings follow the same H2 scale automatically

## Key Decisions
- **Systematic scale over surgical fix**: A ratio-based approach is more maintainable and makes future heading additions consistent
- **vw over vh**: Viewport width is the correct axis for type scaling on mobile
- **Fluid body as the anchor**: One `clamp` on `html/body` drives everything else via `rem`

## Outstanding Questions

### Deferred to Planning
- [Affects R1][Technical] What `vw` value in the clamp middle gives a smooth transition from 18px at 375px to 24px at ~900px? (roughly `calc(18px + (24 - 18) * ((100vw - 375px) / (900 - 375)))`, or a rounded `vw` approximation)
- [Affects R3][Technical] Verify perfect fourth (1.333) vs major third (1.25) ratio against the actual rendered output — compare both options in the browser before committing

## Next Steps
→ Proceed directly to work — changes are limited to one CSS file, decisions are clear, and visual verification in the browser is the primary validation
