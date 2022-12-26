context('browse', () => {
	it('works', () => {
		cy.visit('/');
		cy.get('#category-tops .carousel').should('have.attr', 'data-index', '0');
		cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '0');

		cy.get('#browse').click();
		cy.get('#category-tops .carousel').should('not.have.attr', 'data-index', '0');
		cy.get('#category-skirts .carousel').should('not.have.attr', 'data-index', '0');

		cy.get('#category-tops .carousel').invoke('attr', 'data-index').then((topsIndex) => {
			cy.get('#category-skirts .carousel').invoke('attr', 'data-index').then((skirtsIndex) => {
				cy.get('#browse').click();
				cy.get('#category-tops .carousel').should('not.have.attr', 'data-index', topsIndex);
				cy.get('#category-skirts .carousel').should('not.have.attr', 'data-index', skirtsIndex);
			});
		});
	});
});
