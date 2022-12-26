context('dress me', () => {
	it('works', () => {
		cy.visit('/');
		cy.get('#dress-me').click();
		cy.get('body').should('have.class', 'flash');
		cy.get('#mismatch').should('not.be.visible');
		cy.get('body').should('not.have.class', 'flash');

		cy.get('#category-tops .carousel-button--next').click();
		cy.get('#category-tops .carousel').should('have.attr', 'data-index', '1');
		cy.get('#dress-me').click();
		cy.get('body').should('not.have.class', 'flash');
		cy.get('#mismatch').should('be.visible');
	});
});
