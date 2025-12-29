context('nav', () => {
	context('back', () => {
		it('works', () => {
			cy.visit('/');
			cy.waitToLoad();
			cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '0');

			cy.wait(800);
			cy.get('#category-skirts .carousel-button--back').click();
			cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '10');

			cy.wait(800);
			cy.get('#category-skirts .carousel-button--back').click();
			cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '9');

			cy.wait(800);
			cy.get('#category-skirts .carousel-button--back').click();
			cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '8');

			cy.wait(800);
			cy.get('#category-skirts .carousel-button--back').click();
			cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '7');

			cy.wait(800);
			cy.get('#category-skirts .carousel-button--back').click();
			cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '6');

			cy.wait(800);
			cy.get('#category-skirts .carousel-button--back').click();
			cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '5');

			cy.wait(800);
			cy.get('#category-skirts .carousel-button--back').click();
			cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '4');

			cy.wait(800);
			cy.get('#category-skirts .carousel-button--back').click();
			cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '3');

			cy.wait(800);
			cy.get('#category-skirts .carousel-button--back').click();
			cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '2');

			cy.wait(800);
			cy.get('#category-skirts .carousel-button--back').click();
			cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '1');

			cy.wait(800);
			cy.get('#category-skirts .carousel-button--back').click();
			cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '0');
		});
	});

	context('randomize', () => {
		it('works', () => {
			cy.visit('/');
			cy.waitToLoad();
			cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '0');
			cy.get('#category-skirts .carousel-button--randomize').click();
			cy.get('#category-skirts .carousel').should('not.have.attr', 'data-index', '0');

			cy.get('#category-skirts .carousel')
				.invoke('attr', 'data-index')
				.then((skirtsIndex) => {
					cy.get('#category-skirts .carousel-button--randomize').click();
					cy.get('#category-skirts .carousel').should('not.have.attr', 'data-index', skirtsIndex);
				});
		});

		context('with next', () => {
			it('works', () => {
				cy.visit('/');
				cy.waitToLoad();
				cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '0');
				cy.get('#category-skirts .carousel-button--randomize').click();
				cy.get('#category-skirts .carousel').should('not.have.attr', 'data-index', '0');

				cy.get('#category-skirts .carousel')
					.invoke('attr', 'data-index')
					.then((skirtsIndex) => {
						const expectedIndex = skirtsIndex === '10' ? 0 : parseInt(skirtsIndex, 10) + 1;
						cy.wait(800);
						cy.get('#category-skirts .carousel-button--next').click();
						cy.get('#category-skirts .carousel').should('have.attr', 'data-index', expectedIndex);
					});
			});
		});

		context('with back', () => {
			it('works', () => {
				cy.visit('/');
				cy.waitToLoad();
				cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '0');
				cy.get('#category-skirts .carousel-button--randomize').click();
				cy.get('#category-skirts .carousel').should('not.have.attr', 'data-index', '0');

				cy.get('#category-skirts .carousel')
					.invoke('attr', 'data-index')
					.then((skirtsIndex) => {
						cy.wait(800);
						cy.get('#category-skirts .carousel-button--back').click();
						cy.get('#category-skirts .carousel').should('have.attr', 'data-index', parseInt(skirtsIndex, 10) - 1);
					});
			});
		});
	});

	context('next', () => {
		it('works', () => {
			cy.visit('/');
			cy.waitToLoad();
			cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '0');

			cy.wait(800);
			cy.get('#category-skirts .carousel-button--next').click();
			cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '1');

			cy.wait(800);
			cy.get('#category-skirts .carousel-button--next').click();
			cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '2');

			cy.wait(800);
			cy.get('#category-skirts .carousel-button--next').click();
			cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '3');

			cy.wait(800);
			cy.get('#category-skirts .carousel-button--next').click();
			cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '4');

			cy.wait(800);
			cy.get('#category-skirts .carousel-button--next').click();
			cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '5');

			cy.wait(800);
			cy.get('#category-skirts .carousel-button--next').click();
			cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '6');

			cy.wait(800);
			cy.get('#category-skirts .carousel-button--next').click();
			cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '7');

			cy.wait(800);
			cy.get('#category-skirts .carousel-button--next').click();
			cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '8');

			cy.wait(800);
			cy.get('#category-skirts .carousel-button--next').click();
			cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '9');

			cy.wait(800);
			cy.get('#category-skirts .carousel-button--next').click();
			cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '10');

			cy.wait(800);
			cy.get('#category-skirts .carousel-button--next').click();
			cy.get('#category-skirts .carousel').should('have.attr', 'data-index', '0');
		});
	});
});
