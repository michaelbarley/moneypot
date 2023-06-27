# MoneyPot

MoneyPot is an innovative online platform that enables users to create, manage, and share monetary "pots" or contribution pools. These pots can serve various purposes such as swear jars, crowdfunding initiatives, and more. Users can create pots that are either public or private, based on their requirements.

Built with Laravel, Vue.js, and Inertia.js, MoneyPot provides a robust and user-friendly experience.

## Features

- User Registration and Authentication: Users can create an account, and our system ensures secure authentication via login methods and active session checks.
- Pot Creation: Registered users can establish pots with a custom name and an optional goal value.
- Pot Visibility: Users can define the visibility of the pots - public pots are accessible to all registered users, whereas private pots can be selectively shared.
- User Roles: Private pots allow both contributors and administrators. While all users can contribute, only administrators have the authority to close a pot, make a withdrawal, or alter pot settings.
- Pot Management: Administrators can suspend or resume a pot at any time, impacting the ability to contribute or withdraw. Additionally, admins can set pots to automatically close upon reaching a target value.
- Contributions: Users can contribute any amount (£1 or more) to a pot, with an option to add a reference to each contribution.
- User Profile: Users can view all pots they have access to and track their transaction history in a dedicated profile area.
