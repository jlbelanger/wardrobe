Cypress.Commands.add('waitToLoad', () => {
	cy.get('#hangers').should('not.exist');
	cy.get('.invisible').should('not.exist');
});
