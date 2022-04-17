context('categories', () => {
	it('works', () => {
		cy.visit('/');
		cy.get('#category-tops').should('be.visible');
		cy.get('#category-skirts').should('be.visible');
		cy.get('#category-scarves').should('not.be.visible');
		cy.get('#category-sweaters').should('not.be.visible');
		cy.get('#category-dresses').should('not.be.visible');

		cy.get('#category-input-tops + label').click();
		cy.get('#category-tops').should('not.be.visible');
		cy.get('#category-skirts').should('be.visible');
		cy.get('#category-scarves').should('not.be.visible');
		cy.get('#category-sweaters').should('not.be.visible');
		cy.get('#category-dresses').should('not.be.visible');

		cy.get('#category-input-skirts + label').click();
		cy.get('#category-tops').should('not.be.visible');
		cy.get('#category-skirts').should('not.be.visible');
		cy.get('#category-scarves').should('not.be.visible');
		cy.get('#category-sweaters').should('not.be.visible');
		cy.get('#category-dresses').should('not.be.visible');

		cy.get('#category-input-tops + label').click();
		cy.get('#category-input-skirts + label').click();
		cy.get('#category-input-scarves + label').click();
		cy.get('#category-input-sweaters + label').click();
		cy.get('#category-input-dresses + label').click();
		cy.get('#category-tops').should('be.visible');
		cy.get('#category-skirts').should('be.visible');
		cy.get('#category-scarves').should('be.visible');
		cy.get('#category-sweaters').should('be.visible');
		cy.get('#category-dresses').should('be.visible');
	});
});
