context('categories', () => {
	it('works', () => {
		cy.visit('/');
		cy.get('#category-tops').should('be.visible');
		cy.get('#category-skirts').should('be.visible');
		cy.get('#category-scarves').should('not.be.visible');
		cy.get('#category-sweaters').should('not.be.visible');
		cy.get('#category-dresses').should('not.be.visible');

		cy.get('#category-input-tops').click();
		cy.get('#category-tops').should('not.be.visible');
		cy.get('#category-skirts').should('be.visible');
		cy.get('#category-scarves').should('not.be.visible');
		cy.get('#category-sweaters').should('not.be.visible');
		cy.get('#category-dresses').should('not.be.visible');

		cy.get('#category-input-skirts').click();
		cy.get('#category-tops').should('not.be.visible');
		cy.get('#category-skirts').should('not.be.visible');
		cy.get('#category-scarves').should('not.be.visible');
		cy.get('#category-sweaters').should('not.be.visible');
		cy.get('#category-dresses').should('not.be.visible');

		cy.get('#category-input-tops').click();
		cy.get('#category-input-skirts').click();
		cy.get('#category-input-scarves').click();
		cy.get('#category-input-sweaters').click();
		cy.get('#category-input-dresses').click();
		cy.get('#category-tops').should('be.visible');
		cy.get('#category-skirts').should('be.visible');
		cy.get('#category-scarves').should('be.visible');
		cy.get('#category-sweaters').should('be.visible');
		cy.get('#category-dresses').should('be.visible');
	});
});
