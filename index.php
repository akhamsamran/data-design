<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8"/>
		<title>data-design</title>
		<link rel="stylesheet" href="css/style.css"/>
	</head>
	<body>
		<!--semantic tag <main> used, plan in future to add <header> above and <footer> below, but not needed for now, but want to be sure that the main tag is correctly labeled and filled with content-->
		<!-- 2 <div>s within the <main> div: to separate the Backend Entities/Attributes section from the Frontend Persona/use Case sections -->
		<main>
			<h1>Data Design</h1>
			<p>1/10/2018 Anna Khamsamran</p>
			<!-- this <div> is to hold the Backend Entities/Attributes and keep it separate from the frontend stuff-->
			<div>
				<h2>Entities and Attributes</h2>
				<!--the <p> below is to enter information about what website/app this is about, or notes on the project-->
				<p>Here is a first-attempt to grok <em>Medium</em> blog website</p>
				<!--the entity tables below each have space for up to 10 attributes. In the case that there are less, rows can be deleted, but no more should be added to a table, as each entity should have not more than 10 attributes.  Copy and paste a whole table when more are needed, delete the ones that are not needed.-->
				<hr/>
				<table>
					<tr>
						<th colspan="3"><strong>profile</strong> (Entity)</th>
					</tr>
					<tr>
						<th>attributeName:(entityAttribute)</th>
						<th>PrimaryKey:</th>
						<th>Note:</th>
					</tr>
					<tr>
						<td>profileId</td>
						<td>Primary Key</td>
						<td>profileId (primary key)</td>
					</tr>
					<tr>
						<td>profileFirstName</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>profileLastname</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>profileEmail</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>profileHash</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>profileSalt</td>
						<td></td>
						<td></td>
					</tr>

					<tr>
						<td>profileAboutMe</td>
						<td></td>
						<td></td>
					</tr>
				</table>
				<!--The tables were running into each other, so I added the horizontal break between each of them, just to distinguish them from each other-->
				<hr/>

				<table>
					<tr>
						<th colspan="3"><strong>blog</strong> (Entity)</th>
					</tr>
					<tr>
						<th>attributeName (entityAttribute:)</th>
						<th>PrimaryKey:</th>
						<th>Note:</th>
					</tr>
					<tr>
						<td>blogId</td>
						<td>primary key</td>
						<td></td>
					</tr>
					<tr>
						<td>blogTitle</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>BlogContent</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>blogProfileId</td>
						<td>Foreign Key</td>
						<td>relationship to member entity. 1-to-n = member-to-blog</td>
					</tr>
					<tr>
						<td>blogDate</td>
						<td></td>
						<td>date and time</td>
					</tr>
				</table>
				<hr/>
				<table>
					<tr>
						<th colspan="3"><strong>clap</strong> (Entity)</th>
					</tr>
					<tr>
						<th>attributeName (entityAttribute:)</th>
						<th>PrimaryKey:</th>
						<th>Note:</th>
					</tr>
					<tr>
						<td>clapId</td>
						<td>Primary Key</td>
						<td>this attribute may not be necessary because of the following 2 attributes combined can be co-primary keys</td>
					</tr>
					<tr>
						<td>clapProfileId</td>
						<td>Foreign Key</td>
						<td>relationship to member entity: 1-to-n = member-to-clap(each member can clap n times)</td>
					</tr>
					<tr>
						<td>clapBlogId</td>
						<td>Foreign Key</td>
						<td>relationship to blog entity: 1-to-n = blog-to-clap (each blog can have n claps)</td>
					</tr>
				</table>

				<p>Note: the clap entity is an intermediary table between the member table and the blog table. It allows for a m-to-n relationship, by having 1-to-n relationships with both member and blog. This site allows members to clap multiple times for a single blog, so this is required,since each member can give a different number of claps. it is NOT the same as a "like" in Facebook</p>
				<p>Relationship Note: Profile has a many to many relationship with articles through claps: a profle can clap multiple times for multiple blogs.  However, the clap has 1 to many relationships with both blog and profile</p>
			</div>
			<hr/>
			<!--this <div> is to hold all the front-end items. enter the "answer" or the information following the </strong> for each category. The "name of each required item is in <strong> bold, and the answers should be regular.  This is just a stylistic idea to distinguish question from answer, but is not required.-->
			<div>
				<h2>Personas, Use Cases, and Interaction Flow</h2>
				<h3>Persona:</h3>
				<ul>
					<li><strong>Name</strong>: Alicia</li>
					<li><strong>Personality</strong>: Confident, adventurous, kind. Wants to share her adventures and save the world</li>
					<li><strong>Gender</strong>: Female</li>
					<li><strong>Age</strong>: 24</li>
					<li><strong>Technology</strong>: Comfortable with Windows, Mac and Android
						<ul>
						<li><strong>Device</strong> Samsung Galaxy 7 phone, macbook pro (2011)</li>
						<li><strong>Proficiency</strong> Feels highly competent on all technology, learns new tech fast</li>
						<li><strong>Love/Hate</strong> Loves it!  Checks Instagram and Facebook daily. Shares photos, texts, calls, emails.</li>
						</ul>
					</li>
					<li><strong>Attitudes and Needs</strong>
						<ul>
							<li><strong>What need does this person have?</strong> She needs a blogging platform with a seamless, beautiful interface where she can post her articles from her travels and share with other hikers</li>

							<li><strong>Why choose your site over other options?</strong> Medium is beautiful, easy for her family back home to use, and allows commenting, and highlighting directly within the text of the article.</li>
						</ul>
					</li>
				</ul>

				<h3>User Story</h3>
				<h4>As a member of Medium, I want to post articles</h4>
				<p></p>
				<h3>Use Case</h3>
				<ul>
					<li><strong>Title: </strong> Through-Hiking the Appalachian Trail</li>
					<li><strong>Name of the "actor, user or Persona, and their role: </strong> Alicia, Through-Hiker</li>
					<li><strong>Usage Preconditions: </strong> Alicia needs to be a member of Medium and be signed in (Has to be in a place where she has wifi access)</li>
					<li><strong>Usage Postconditions:</strong> Alicia's article is posted and available for her friends to read while she continues hiking.</li>
					<li><strong>Interaction Flow(s), including alternates, if appropriate</strong></li>
					<li><strong>Frequency of Use: </strong> once-a-week</li>
				</ul>
				<h3>Interaction Flow:</h3>
				<!--Enter each after the </strong> and before the </li>-->
				<ul>
					<li><strong>User Action 1</strong> Alicia enters her username and password.</li>
					<li><strong>System Response 1</strong> Medium logs her in.</li>
					<li><strong>User Action 2</strong> Alicia clicks that she wants to post an article.</li>
					<li><strong>System Response 2</strong> Medium opens a box in which she can write or cut and paste her article, with an area for title and for content.</li>
					<li><strong>User Action 3</strong> Alicia enters her article, with title and content.</li>
					<li><strong>System Response 3</strong> Medium saves her article and displays it for other members to read.</li>
					<li><strong>User Action 4</strong> Alicia clicks the logout button.</li>
					<li><strong>System Response 4</strong> Medium logs Alicia out.</li>
				</ul>
			</div>

			<!--here's a div for my ERD:-->
			<div>
				<h2>ERD for <em>Medium</em> website</h2>
				<!--I used an <object> tag to add this svg image to the page, since this was the most recommended option on https://www.sitepoint.com/add-svg-to-web-page/ If you intend using any advanced SVG features such as CSS and scripting, the HTML5 <object> tag is your best option"-->
				<img src="images/erd-sm.png" alt="Image ERD (small)" />
			</div>

		</main>
	</body>
</html>