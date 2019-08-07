import React from 'react';
import { Posts } from "./block1";
import renderer from 'react-test-renderer';
import { shallow } from 'enzyme';

describe('Posts component', () => {
	/** Mock WordPress post to test with**/
	const posts = [
		{
			title: {
				rendered: 'Hi Roy'
			},
			content: {
				rendered: 'Lorem ipsum, etc.'
			}
		},
		{
			title: {
				rendered: 'Hi Mike'
			},
			content: {
				rendered: 'Lorem ipsum, etc.'
			}
		},
	];


	it('Matches snapshot with basic props', () => {
		const component = renderer.create(
			<Posts
				posts={posts}
			/>
		);
		expect(component.toJSON()).toMatchSnapshot();
	});

	it('Applies className to outermost element', () => {
		const component = renderer.create(
			<Posts
				posts={posts}
				className={'food'}
			/>
		);
		expect(component.toJSON()).toMatchSnapshot();
	});
});
