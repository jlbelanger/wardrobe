context('seasons', () => {
	it('works', () => {
		cy.visit('/');
		cy.get('#category-skirts .carousel__item:first-of-type').should('not.have.class', 'hide');

		cy.get('#seasons').select('Winter Wear');
		cy.get('#category-skirts .carousel__item:first-of-type').should('have.class', 'hide');

		cy.get('#seasons').select('Fall Fashions');
		cy.get('#category-skirts .carousel__item:first-of-type').should('not.have.class', 'hide');
	});
});
