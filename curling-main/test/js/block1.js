import React from 'react';
import PropTypes from 'prop-types';

export const Posts = (props) =>  {
	return(
		<div
			className={props.className}
		>
			<p>Hi Roys</p>
		</div>
	);
};

Posts.propTypes = {
	className: PropTypes.string.isRequired,
	posts: PropTypes.arrayOf(
			PropTypes.shape({
			title: PropTypes.shape({
				rendered: PropTypes.string,
			}).isRequired,
			content: PropTypes.shape({
				rendered: PropTypes.string,
			}).isRequired,
		}).isRequired
	)
};

Posts.defaultProps = {
	className: 'post-list-wrapper'
};
